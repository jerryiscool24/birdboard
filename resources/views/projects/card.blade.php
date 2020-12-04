<div class="card" style="height: 200px;">
    <h3 class="text-xl font-weight-bold py-4 -ml-5 mb-3 border-l-4 border-blue-400 pl-4">
        <a href="{{ $project->path() }}">{{ $project->title }}</a></h3>

    <div class=" text-gray-400 mb-4">{{ Str::limit($project->description, 50) }}</div>

    <footer>
        <form method="POST" action="{{ $project->path() }}" class="text-right">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm">Delete</button>
        </form>
    </footer>
</div>