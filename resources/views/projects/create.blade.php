<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Create a Project
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="/projects">
                    @csrf
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid gap-6">

                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="title">
                                    Title
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="title" type="text"
                                    autocomplete="title">

                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="description">
                                    Description
                                </label>

                                <textarea
                                    class="resize-none border rounded focus:outline-none focus:shadow-outline w-full" style="min-height: 200px"></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 mr-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-blue-600 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>

                        <a href="/projects" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-200 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>