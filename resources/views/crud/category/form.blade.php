@csrf
@if (!empty($edit))
    @method('PUT')
@endif
<div class="grid gap-4">
    <div class="grid gap-1">
        <label class="font-semibold"
            for="name">{{ __('Name') }}</label>
        <input class="rounded-md" id="name" name="name"
            placeholder="{{ __('Category name') }}" type="text"
            value="{{ $category->name ?? old('name') }}" />
        @error('name')
            <p class="text-sm text-rose-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="grid gap-1">
        <label class="font-semibold"
            for="is_featured">{{ __('Is featured') }}</label>
        <select class="rounded-md" id="is_featured" name="is_featured">
            @if (!empty($category->is_featured))
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
    <div class="grid md:justify-end">
        <button class="rounded-md bg-indigo-600 px-2 py-1 text-white"
            type="submit">{{ empty($edit) ? __('Register') : __('Save') }}</button>
    </div>
</div>
