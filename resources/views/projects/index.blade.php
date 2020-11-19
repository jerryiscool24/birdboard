<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                My Projects
            </h2>

            <a href="/projects/create" class="text-sm bg-blue-500 text-white py-2 px-5 rounded-lg shadow-md">Add
                Project</a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:flex-wrap -mx-3">
            @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
               @include ('projects.card')
            </div>
            @empty
            <div>No projects yet.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>