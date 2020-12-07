<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between">
            <p class="font-semibold text-xl leading-tight">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img src="{{ gravatar_url($member->email) }}" alt="{{ $member->name }}'s avatar" class="rounded-full w-7 mr-2">
                @endforeach
                 <img src="{{ gravatar_url($project->owner->email) }}" alt="{{ $project->owner->name }}'s avatar" class="rounded-full w-7 mr-2">
                <a href="{{ $project->path() . '/edit' }}" class="text-sm bg-blue-500 text-white py-2 px-5 rounded-lg shadow-md ml-4">Edit
                    Project</a>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <div class="lg:flex -mx-3">
                <div class="lg:w-3/4 px-3 mb-6">
                    <div class="mb-8">
                        <h2 class="text-lg text-gray-400 font-normal mb-3">Tasks</h2>
                        @foreach ($project->tasks as $task)
                            <div class="card mb-3">
                                <form action="{{ $task->path() }}" method="POST">
                                    @method('PATCH')
                                    @csrf

                                    <div class="flex items-center">
                                        <input type="text" name="body" value="{{ $task->body }}"
                                            class="w-full {{ $task->completed ? 'text-gray-400' : '' }}">
                                        <input type="checkbox" name="completed" onchange="this.form.submit()"
                                            {{ $task->completed ? 'checked' : '' }}>
                                    </div>
                                </form>
                            </div>
                        @endforeach

                        <div class="card mb-3">
                            <form action="{{ $project->path() .'/tasks'}}" method="POST">
                                @csrf
                                <input type="text" name="body" class="w-full" placeholder="Begin adding task...">
                            </form>
                        </div>
                    </div>

                    {{-- tasks --}}

                    <div>
                        <h2 class="text-lg text-gray-400 font-normal mb-3">General Notes</h2>

                        {{-- general notes --}}
                        <form action="{{ $project->path() }}" method="POST">
                            @method('PATCH')
                            @csrf

                            <textarea
                                name="notes"
                                class="card resize-none w-full mb-4"
                                style="min-height: 200px"
                                placeholder="Anything special that you want to make a note of?"
                            >{{ $project->notes }}</textarea>

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 mr-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-blue-600 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
                <div class="lg:w-1/4 px-3">
                    @include ('projects.card')
                    @include ('projects.activity.card')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>