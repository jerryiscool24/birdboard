<div class="card flex flex-col mt-3">
    <h3 class="text-xl font-weight-bold py-4 -ml-5 mb-3 border-l-4 border-blue-400 pl-4">
        Invite a User</h3>
    <form method="POST" action="{{ $project->path() . '/invitations' }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="border border-grey-light rounded py-2 px-3 w-full" placeholder="Email address">
            @error('email')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="text-sm bg-blue-500 text-white py-2 px-5 rounded-lg shadow-md">Invite</button>
    </form>
</div>