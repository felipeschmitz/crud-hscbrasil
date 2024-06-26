<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product): View
    {
        $products = $product
            ->with(['brand', 'category'])
            ->withCount('skus')
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('crud.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('crud.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $data = $request->except('sku');
            $data['slug'] = Str::slug($data['name']);

            $product = Product::create($data);

            $skus = $product->skus()->createMany($request->get('sku'));

            foreach ($skus as $k => $sku) {
                foreach ($request->sku[$k]['images'] as $i => $image) {
                    $path = $image['url']->store('products');

                    $sku->images()->create([
                        'url'   => $path,
                        'cover' => $i == 0,
                    ]);
                }
            }

            return $product->load('skus.images');
        });

        return redirect()->route('product.index')->with('success', __('Product created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $product = $product->load(['brand', 'category', 'skus.images']);

        return view('crud.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        $product = $product->load(['brand', 'category', 'skus.images']);

        return view('crud.product.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        DB::transaction(function () use ($request, $product) {
            $data = $request->except('sku');

            $product->update($data);

            foreach ($request->sku as $k => $sku) {
                $sku = $product->skus()->updateOrCreate(['id' => $sku['id'] ?? 0], $sku);

                if (isset($request->sku[$k]['images'])) {
                    foreach ($request->sku[$k]['images'] as $i => $image) {
                        $path = $image['url']->store('products');

                        $sku->images()->create([
                            'url'   => $path,
                            'cover' => $i == 0,
                        ]);
                    }
                }
            }

            return $product->load('skus.images');
        });

        return redirect()->route('product.index')->with('success', __('Product updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        DB::transaction(function () use ($product) {
            $product->load('skus.images');
            foreach ($product->skus as $sku) {
                foreach ($sku->images as $image) {
                    $image->delete();
                }
                $sku->delete();
            }
            $product->delete();
        });

        return redirect()->route('product.index')->with('success', __('Product deleted successfully'));
    }
}
