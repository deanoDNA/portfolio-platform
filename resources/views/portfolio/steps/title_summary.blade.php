@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-4">
    <div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl p-8 relative">

        <!-- Progress -->
        <div class="absolute -top-5 left-1/2 -translate-x-1/2 bg-blue-600 text-white px-6 py-1 rounded-full text-sm shadow">
            Step 2 of 5
        </div>

        <h2 class="text-3xl font-bold text-center text-gray-800 mt-4">Portfolio Details</h2>
        <p class="text-center text-gray-500 mb-8">
            Add a professional title and a short summary
        </p>

        <form method="POST" action="{{ route('portfolio.storeStep2') }}" class="space-y-5">
            @csrf

            <!-- Title -->
            <div>
                <label class="text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title"
                    class="mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('title', $portfolio->title ?? '') }}"
                    placeholder="Software Developer" required>
            </div>

            <!-- Summary -->
            <div>
                <label class="text-sm font-medium text-gray-700">Summary</label>
                <textarea name="summary"
                    class="mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Short professional summary" rows="4">{{ old('summary', $portfolio->summary ?? '') }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center">
                <a href="{{ route('portfolio.step1') }}"
                   class="text-gray-600 hover:text-gray-900">
                    ← Back
                </a>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Save & Continue →
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
