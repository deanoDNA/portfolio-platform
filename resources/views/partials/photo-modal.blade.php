<div x-cloak x-show="open" x-transition class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div @click.outside="open=false" class="bg-white rounded shadow p-6 w-80">
        <h3 class="text-sm font-semibold text-gray-800 mb-3">Update Profile Photo</h3>
        <form method="POST"
      action="{{ route('portfolio.updatePhoto') }}"
      enctype="multipart/form-data">
    @csrf
    <input type="file" name="profile_photo"
           accept="image/*"
           @change="previewImage"
           required
           class="block w-full text-sm mb-3">

    <template x-if="preview">
        <img :src="preview" class="w-32 h-32 mx-auto rounded-full object-cover mb-3">
    </template>

    <div class="flex justify-end gap-2">
        <button type="button" @click="open=false" class="px-3 py-1 text-sm border rounded">
            Cancel
        </button>
        <button type="submit" class="px-3 py-1 text-sm bg-gray-800 text-white rounded">
            Save
        </button>
    </div>
</form>

    </div>
</div>
