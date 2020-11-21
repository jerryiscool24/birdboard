<div class="px-4 py-5 bg-white sm:p-6">
    <div class="grid gap-6">

        <div class="col-span-6 sm:col-span-4">
            <label class="block font-medium text-sm text-gray-700" for="title">
                Title
            </label>

            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="title" id="title" type="text"
                autocomplete="title" value="{{ $project->title }}">

        </div>

        <div class="col-span-6 sm:col-span-4">
            <label class="block font-medium text-sm text-gray-700" for="description">
                Description
            </label>

            <textarea
                class="resize-none border rounded focus:outline-none focus:shadow-outline w-full" name="description" style="min-height: 200px">{{ $project->description }}</textarea>

        </div>
    </div>
</div>

<div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
    <button type="submit"
        class="inline-flex items-center px-4 py-2 mr-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-blue-600 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">
        {{ $buttonText }}
    </button>

    <a href="{{ $cancelPath }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-200 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">Cancel</a>
</div>