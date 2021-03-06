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

                    @include('projects._form', [
                        'project' => new App\Models\Project,
                        'buttonText' => 'Create Project',
                        'cancelPath' => '/projects'
                    ])

                </form>
            </div>
        </div>
    </div>
</x-app-layout>