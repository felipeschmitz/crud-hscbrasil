@csrf
@if (!empty($edit))
    @method('PUT')
@endif

@php
    if (!empty($product) && $product->skus) {
        if (old('sku')) {
            foreach (old('sku') as $index => $sku) {
                $errorName = '';
                if ($errors->has("sku.{$index}.name")) {
                    $errorName = $errors->first("sku.{$index}.name");
                }

                $errorQuantity = '';
                if ($errors->has("sku.{$index}.quantity")) {
                    $errorQuantity = $errors->first(
                        "sku.{$index}.quantity",
                    );
                }

                $errorPrice = '';
                if ($errors->has("sku.{$index}.price")) {
                    $errorPrice = $errors->first("sku.{$index}.price");
                }

                $errorImages = '';
                if ($errors->has("sku.{$index}.images.0.url")) {
                    $errorImages = $errors->first(
                        "sku.{$index}.images.0.url",
                    );
                }

                $rows[] = [
                    'id' => [
                        'value' => $sku['id'],
                        'error' => '',
                    ],
                    'name' => [
                        'value' => $sku['name'],
                        'error' => $errorName,
                    ],
                    'quantity' => [
                        'value' => $sku['quantity'],
                        'error' => $errorQuantity,
                    ],
                    'price' => [
                        'value' => $sku['price'],
                        'error' => $errorPrice,
                    ],
                    'images' => [
                        'value' => [],
                        'error' => $errorImages,
                    ],
                ];
            }
        } else {
            foreach ($product->skus as $sku) {
                $images = [];
                foreach ($sku['images'] as $sk) {
                    $images[] = [
                        'id' => $sk['id'],
                        'url' => asset($sk['url']),
                        'cover' => $sk['cover'],
                    ];
                }

                $sku['images'] = $images;

                $rows[] = [
                    'id' => [
                        'value' => $sku['id'],
                        'error' => '',
                    ],
                    'name' => [
                        'value' => $sku['name'],
                        'error' => '',
                    ],
                    'quantity' => [
                        'value' => $sku['quantity'],
                        'error' => '',
                    ],
                    'price' => [
                        'value' => $sku['price'],
                        'error' => '',
                    ],
                    'images' => [
                        'value' => $sku['images'],
                        'error' => '',
                    ],
                ];
            }
        }
    } else {
        if (old('sku')) {
            foreach (old('sku') as $index => $sku) {
                $errorName = '';
                if ($errors->has("sku.{$index}.name")) {
                    $errorName = $errors->first("sku.{$index}.name");
                }

                $errorQuantity = '';
                if ($errors->has("sku.{$index}.quantity")) {
                    $errorQuantity = $errors->first(
                        "sku.{$index}.quantity",
                    );
                }

                $errorPrice = '';
                if ($errors->has("sku.{$index}.price")) {
                    $errorPrice = $errors->first("sku.{$index}.price");
                }

                $errorImages = '';
                if ($errors->has("sku.{$index}.images.0.url")) {
                    $errorImages = $errors->first(
                        "sku.{$index}.images.0.url",
                    );
                }

                $rows[] = [
                    'id' => [
                        'value' => '',
                        'error' => '',
                    ],
                    'name' => [
                        'value' => $sku['name'],
                        'error' => $errorName,
                    ],
                    'quantity' => [
                        'value' => $sku['quantity'],
                        'error' => $errorQuantity,
                    ],
                    'price' => [
                        'value' => $sku['price'],
                        'error' => $errorPrice,
                    ],
                    'images' => [
                        'value' => [],
                        'error' => $errorImages,
                    ],
                ];
            }
        } else {
            $rows = [
                [
                    'id' => [['value' => '', 'error' => '']],
                    'name' => [['value' => '', 'error' => '']],
                    'quantity' => [['value' => '', 'error' => '']],
                    'price' => [['value' => '', 'error' => '']],
                    'images' => [['value' => [], 'error' => '']],
                ],
            ];
        }
    }
@endphp

<div class="grid grid-cols-1 gap-4">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="grid gap-1">
            <label class="font-semibold"
                for="brand_id">{{ __('Brand') }}</label>
            <select class="rounded-md" id="brand_id" name="brand_id">
                <option value="">{{ __('Select option') }}
                </option>
                @foreach ($brands as $brand)
                    <option
                        {{ (!empty($product->brand_id) && $product->brand_id == $brand->id) || old('brand_id') == $brand->id ? 'selected' : '' }}
                        value="{{ $brand->id }}">
                        {{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id')
                <p class="text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="grid gap-1">
            <label class="font-semibold"
                for="category_id">{{ __('Category') }}</label>
            <select class="rounded-md" id="category_id" name="category_id">
                <option value="">{{ __('Select option') }}
                </option>
                @foreach ($categories as $category)
                    <option
                        {{ (!empty($product->category_id) && $product->category_id == $category->id) || old('category_id') == $category->id ? 'selected' : '' }}
                        value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="grid gap-1">
        <label class="font-semibold"
            for="name">{{ __('Name') }}</label>
        <input class="rounded-md" id="name" name="name"
            placeholder="{{ __('Product name') }}" type="text"
            value="{{ $product->name ?? old('name') }}" />
        @error('name')
            <p class="text-sm text-rose-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="grid gap-1">
        <label class="font-semibold"
            for="description">{{ __('Description') }}</label>
        <textarea class="h-64 rounded-md" id="description" name="description"
            placeholder="{{ __('Product description') }}">{{ $product->description ?? old('description') }}</textarea>
        @error('description')
            <p class="text-sm text-rose-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="grid gap-1">
        <label class="font-semibold"
            for="is_featured">{{ __('Is featured') }}</label>
        <select class="rounded-md" id="is_featured" name="is_featured">
            @if (!empty($product->is_featured))
                <option selected value="1">{{ __('Yes') }}
                </option>
                <option value="0">{{ __('No') }}</option>
            @else
                <option value="1">{{ __('Yes') }}</option>
                <option selected value="0">{{ __('No') }}
                </option>
            @endif
        </select>
        @error('is_featured')
            <p class="text-sm text-rose-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="grid gap-1">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3"
            x-data="{
                rows: @js($rows),
                addRow() {
                    this.rows = [...this.rows, {
                        id: {
                            value: '',
                            error: ''
                        },
                        name: {
                            value: '',
                            error: ''
                        },
                        quantity: {
                            value: '',
                            error: ''
                        },
                        price: {
                            value: '',
                            error: ''
                        },
                        images: {
                            value: [],
                            error: ''
                        },
                    }]
                },
                deleteRow(index) {
                    this.rows.splice(index, 1);
                }
            }">
            <div
                class="col-span-3 flex items-center space-x-2 sm:col-span-3">
                <h2 class="text-3xl font-semibold">{{ __('SKUs') }}
                </h2>
                <button @click.prevent="addRow()"
                    class="rounded-md bg-sky-600 p-1 text-center text-sm text-white hover:bg-sky-700">
                    <svg class="size-4" fill="none" stroke-width="1.5"
                        stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5v15m7.5-7.5h-15"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <template :key="index" x-for="(row, index) in rows">
                <div class="relative grid gap-4">
                    <input :name="`sku[${index}][id]`"
                        :value="row.id.value" type="hidden">
                    <div class="grid gap-1">
                        <label :for="`sku-name-${index}`"
                            class="font-semibold">{{ __('SKU Name') }}</label>
                        <input :id="`sku-name-${index}`"
                            :name="`sku[${index}][name]`"
                            :value="row.name.value" class="rounded-md"
                            placeholder="{{ __('SKU Name') }}"
                            type="text" />
                        <p class="text-sm text-rose-500"
                            x-text="row.name.error"></p>
                    </div>
                    <div class="grid gap-1">
                        <label :for="`sku-price-${index}`"
                            class="font-semibold">{{ __('SKU Price') }}</label>
                        <input :id="`sku-price-${index}`"
                            :name="`sku[${index}][price]`"
                            :value="row.price.value" class="rounded-md"
                            pattern="^\d+(?:\.\d{1,2})?$"
                            placeholder="{{ __('SKU Price') }}"
                            step="0.01" type="number" />
                        <p class="text-sm text-rose-500"
                            x-text="row.price.error"></p>
                    </div>
                    <div class="grid gap-1">
                        <label :for="`sku-quantity-${index}`"
                            class="font-semibold">{{ __('SKU Quantity') }}</label>
                        <input :id="`sku-quantity-${index}`"
                            :name="`sku[${index}][quantity]`"
                            :value="row.quantity.value" class="rounded-md"
                            placeholder="{{ __('SKU Quantity') }}"
                            type="number" />
                        <p class="text-sm text-rose-500"
                            x-text="row.quantity.error"></p>
                    </div>
                    <div class="grid gap-1">
                        <label :for="`sku-images-${index}`"
                            class="font-semibold">{{ __('SKU Images') }}</label>
                        <input :id="`sku-images-${index}`"
                            :name="`sku[${index}][images][][url]`"
                            multiple type="file">
                        <p class="text-sm text-rose-500"
                            x-text="row.images.error"></p>
                    </div>
                    <template x-if="row.images.value">
                        <div class="grid gap-1">
                            <div
                                class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                <template :key="image.id"
                                    x-for="image in row.images.value">
                                    <img :alt="row.name"
                                        class="h-full w-full object-cover object-center"
                                        x-bind:src="image.url">
                                </template>
                            </div>
                        </div>
                    </template>
                    <button @click.prevent="deleteRow(index)"
                        class="absolute right-0 top-0 inline-block rounded-md border bg-red-600 p-1 text-white hover:bg-red-700"
                        x-show="index > 0">
                        <svg class="size-4" fill="none"
                            stroke-width="1.5" stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 18 18 6M6 6l12 12"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </template>

        </div>
    </div>
    <div class="grid sm:justify-end">
        <button class="rounded-md bg-indigo-600 px-2 py-1 text-white"
            type="submit">{{ empty($edit) ? __('Register') : __('Save') }}</button>
    </div>
</div>
