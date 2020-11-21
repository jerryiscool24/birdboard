<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Edit a Project
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ $project->path() }}">
                    @csrf
                    @method('PATCH')

                    @include('projects._form', [
                        'buttonText' => 'Edit Project',
                        'cancelPath' => $project->path()
                    ])

                </form>
            </div>
        </div>
    </div>
</x-app-layout>