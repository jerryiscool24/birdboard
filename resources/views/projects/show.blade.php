<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between">
            <p class="font-semibold text-xl leading-tight">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>

            <a href="/projects/create" class="text-sm bg-blue-500 text-white py-2 px-5 rounded-lg shadow-md">Add
                Project</a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <div class="lg:flex -mx-3">
                <div class="lg:w-3/4 px-3 mb-6">
                    <div class="mb-8">
                        <h2 class="text-lg text-gray-400 font-normal mb-3">Tasks</h2>
                        @foreach ($project->tasks as $task)
                            <div class="card mb-3">{{ $task->body }}</div>
                        @endforeach
                    </div>

                    {{-- tasks --}}

                    <div>
                        <h2 class="text-lg text-gray-400 font-normal mb-3">General Notes</h2>
                        {{-- general notes --}}
                        <textarea class="card resize-none w-full" style="min-height: 200px"></textarea>
                    </div>
                </div>
                <div class="lg:w-1/4 px-3">
                    @include ('projects.card')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>