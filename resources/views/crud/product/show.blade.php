<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Show product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2
                        class="mb-2 text-xl font-semibold leading-none text-gray-900 dark:text-white md:text-2xl">
                        {{ $product->name }}</h2>
                    <dl>
                        <dt
                            class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            {{ __('Is featured') }}</dt>
                        <dd
                            class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5">
                            {{ $product->is_featured ? __('Yes') : __('No') }}
                        </dd>
                    </dl>
                    <dl>
                        <dt
                            class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            {{ __('Slug') }}</dt>
                        <dd
                            class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5">
                            {{ $product->slug }}
                        </dd>
                    </dl>
                    <dl>
                        <dt
                            class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            {{ __('Description') }}</dt>
                        <dd
                            class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5">
                            {{ $product->description }}
                        </dd>
                    </dl>
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700"
                        x-data="{ active: 'active-0' }">
                        <ul
                            class="flex flex-wrap border-b border-gray-200 text-center text-sm font-medium text-gray-500 dark:border-gray-700 dark:text-gray-400">
                            @foreach ($product->skus as $sku)
                                <li class="me-2">
                                    <a :class="{ 'text-blue-600 dark:text-blue-500': active === 'active-{{ $loop->index }}' }"
                                        @click.prevent="active = 'active-{{ $loop->index }}'"
                                        aria-current="page"
                                        class="inline-block rounded-t-lg bg-gray-100 p-4 dark:bg-gray-800"
                                        href="#">SKU
                                        {{ $sku->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div id="default-tab-content">
                            @foreach ($product->skus as $sku)
                                <div aria-labelledby="profile-tab"
                                    class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800"
                                    role="tabpanel" x-cloak
                                    x-show="active === 'active-{{ $loop->index }}'">
                                    <dl>
                                        <dt
                                            class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                            {{ __('Name') }}</dt>
                                        <dd
                                            class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5">
                                            {{ $sku->name }}
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt
                                            class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                            {{ __('Price') }}</dt>
                                        <dd
                                            class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5">
                                            {{ $sku->price }}
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt
                                            class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                            {{ __('Quantity') }}</dt>
                                        <dd
                                            class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5">
                                            {{ $sku->quantity }}
                                        </dd>
                                    </dl>
                                    <div
                                        class="grid grid-cols-1 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                                        @foreach ($sku->images as $image)
                                            <div class="relative">
                                                @if ($image->cover)
                                                    <div
                                                        class="absolute right-0 top-0 bg-black px-2 py-1 text-xs text-white">
                                                        {{ __('Is cover') }}
                                                    </div>
                                                @endif
                                                <img alt="{{ $image->name }}"
                                                    class="h-full w-full object-cover object-center"
                                                    src="{{ asset($image->url) }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
