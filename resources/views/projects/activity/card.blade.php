<div class="card mt-3">
    <ul>
        @foreach ($project->activity as $activity)
            <li class="{{ $loop->last ? '' : 'mb-1' }}">
                @include ("projects.activity.{$activity->description}")
                <div class="inline text-gray-500 text-sm">{{ $activity->created_at->diffForHumans(null, true) }}</div>
            </li>
        @endforeach
    </ul>
</div>