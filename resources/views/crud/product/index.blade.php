<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @include('crud.alert')
                    <div class="flex md:justify-end">
                        <a class="mb-4 w-full rounded bg-indigo-600 px-2 py-1 text-center text-white duration-300 hover:bg-indigo-900 md:w-auto"
                            href="{{ route('product.create') }}">{{ __('New Product') }}</a>
                    </div>
                    <table
                        class="w-full table-auto divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    {{ __('Name') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    {{ __('Brand') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    {{ __('Category') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    {{ __('Count SKUs') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    {{ __('Is featured') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    {{ __('Created at') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($products as $product)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4">
                                        {{ $product->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4">
                                        {{ $product->brand->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4">
                                        {{ $product->category->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4">
                                        {{ $product->skus_count }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4">
                                        {{ $product->is_featured ? __('Yes') : __('No') }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4">
                                        {{ $product->created_at }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4">
                                        <div class="flex w-full space-x-1">
                                            <a class="rounded-md bg-sky-600 px-2 py-1 text-sky-100 duration-300 hover:bg-sky-900 hover:text-white"
                                                href="{{ route('product.show', $product) }}">{{ __('Show') }}</a>
                                            <a class="rounded-md bg-emerald-600 px-2 py-1 text-emerald-100 duration-300 hover:bg-emerald-900 hover:text-white"
                                                href="{{ route('product.edit', $product) }}">{{ __('Edit') }}</a>
                                            <form
                                                action="{{ route('product.destroy', $product) }}"
                                                class="flex"
                                                method="POST">
                                                @method('delete')
                                                @csrf

                                                <a class="rounded-md bg-rose-600 px-2 py-1 text-rose-100 duration-300 hover:bg-rose-900 hover:text-white"
                                                    href="{{ route('product.destroy', $product) }}"
                                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
