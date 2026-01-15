<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Skills
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto space-y-6">

        <!-- Add Skill -->
        <div class="bg-white border rounded-lg p-6">
            <form method="POST" action="{{ route('skills.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf

                <input type="text" name="name"
                       placeholder="Skill name"
                       class="rounded border-gray-300"
                       required>

                <select name="level" class="rounded border-gray-300" required>
                    <option value="">Select level</option>
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>
                </select>

                <button class="bg-indigo-600 text-white rounded px-4">
                    Add Skill
                </button>
            </form>
        </div>

        <!-- Skills Table -->
        <div class="bg-white border rounded-lg p-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-left text-sm text-gray-600 border-b">
                        <th class="py-2">Skill</th>
                        <th>Level</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skills as $skill)
                        <tr class="border-b text-sm">
                            <td class="py-2">{{ $skill->name }}</td>
                            <td>{{ $skill->level }}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('skills.destroy', $skill) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-400 py-4">
                                No skills added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
