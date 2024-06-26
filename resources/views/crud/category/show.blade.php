<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Show brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2
                        class="mb-2 text-xl font-semibold leading-none text-gray-900 dark:text-white md:text-2xl">
                        {{ $category->name }}</h2>
                    <dl>
                        <dt
                            class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            {{ __('Is featured') }}</dt>
                        <dd
                            class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5">
                            {{ $category->is_featured ? __('Yes') : __('No') }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
