<x-guest-layout>
    <form method="POST"
          action="{{ route('portfolio.update') }}"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf

        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">
                Edit Your Portfolio
            </h1>
            <p class="text-gray-500 mt-1">
                Update your public profile information
            </p>
        </div>

        <!-- Title -->
        <div>
            <x-input-label for="title" value="Portfolio Title" />
            <x-text-input id="title"
                class="block mt-1 w-full"
                type="text"
                name="title"
                value="{{ old('title', $portfolio->title ?? '') }}"
                required />
            <x-input-error :messages="$errors->get('title')" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" value="Description" />
            <textarea id="description"
                name="description"
                rows="4"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $portfolio->description ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('description')" />
        </div>

        <!-- Website -->
        <div>
            <x-input-label for="website" value="Website" />
            <x-text-input id="website"
                class="block mt-1 w-full"
                type="url"
                name="website"
                value="{{ old('website', $portfolio->website ?? '') }}" />
            <x-input-error :messages="$errors->get('website')" />
        </div>

        <!-- Profile Image -->
        <div>
            <x-input-label for="profile_image" value="Profile Image" />

            @if($portfolio && $portfolio->profile_image)
                <img src="{{ asset('storage/' . $portfolio->profile_image) }}"
                     class="w-20 h-20 rounded-full object-cover my-3 mx-auto">
            @endif

            <input id="profile_image"
                name="profile_image"
                type="file"
                class="block w-full text-sm text-gray-500 mt-1">
            <x-input-error :messages="$errors->get('profile_image')" />
        </div>

        <!-- Submit -->
        <div class="flex justify-center">
            <x-primary-button class="w-full justify-center">
                Save Portfolio
            </x-primary-button>
        </div>

        <!-- Public link -->
        <div class="text-center text-sm text-gray-500">
            View your public page:
            <a href="{{ url('/@' . auth()->user()->username) }}"
               class="text-indigo-600 hover:underline">
                /@{{ auth()->user()->username }}
            </a>
        </div>
    </form>
</x-guest-layout>
