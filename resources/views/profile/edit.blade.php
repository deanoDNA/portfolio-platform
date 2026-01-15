<x-app-layout>
    <x-slot name="header">
        <h2>Profile</h2>
    </x-slot>

    <div class="py-6">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</x-app-layout>
