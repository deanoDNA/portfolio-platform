<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $portfolio->full_name }} | Portfolio</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-200">

<!-- PAGE CONTAINER -->
<div class="max-w-4xl mx-auto my-10 bg-white p-10 shadow">

    <!-- HEADER -->
    <!-- HEADER -->
<div class="flex gap-6 items-center border-b pb-4 mb-6">

    <!-- PHOTO -->
    <div class="w-28 h-28 rounded border overflow-hidden bg-gray-100">
        @if($portfolio->profile_photo)
            <img src="{{ asset('storage/' . $portfolio->profile_photo) }}"
                 class="w-full h-full object-cover"
                 alt="Profile Photo">
        @endif
    </div>

    <!-- NAME -->
    <div>
        <h1 class="text-3xl font-semibold text-gray-900">
            {{ $portfolio->full_name }}
        </h1>

        <p class="text-gray-600 mt-1">
            {{ $portfolio->district->name ?? '' }},
            {{ $portfolio->region->name ?? '' }},
            {{ $portfolio->country->name ?? '' }}
        </p>
    </div>
</div>


    <!-- PERSONAL DETAILS -->
    <section class="mb-6">
        <h2 class="text-lg font-semibold border-b pb-1 mb-3">
            Personal Details
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <p><span class="font-medium">Full Name:</span> {{ $portfolio->full_name }}</p>
            <p><span class="font-medium">Gender:</span> {{ $portfolio->gender }}</p>
            <p><span class="font-medium">Nationality:</span> {{ $portfolio->nationality }}</p>
        </div>
    </section>

    <!-- SKILLS -->
    <section class="mb-6">
        <h2 class="text-lg font-semibold border-b pb-1 mb-3">
            Skills
        </h2>

        <p class="text-sm text-gray-700 whitespace-pre-line">
            {{ $portfolio->skills }}
        </p>
    </section>

    <!-- EDUCATION -->
    <section class="mb-6">
        <h2 class="text-lg font-semibold border-b pb-1 mb-3">
            Education
        </h2>

        <p class="text-sm text-gray-700 whitespace-pre-line">
            {{ $portfolio->education }}
        </p>
    </section>

    <!-- EXPERIENCE -->
    <section class="mb-8">
        <h2 class="text-lg font-semibold border-b pb-1 mb-3">
            Work Experience
        </h2>

        <p class="text-sm text-gray-700 whitespace-pre-line">
            {{ $portfolio->experience }}
        </p>
    </section>

    <!-- ACTIONS -->
    <div class="flex justify-between items-center border-t pt-4">
        <a href="{{ url()->previous() }}"
           class="text-sm text-gray-600 hover:underline">
            ← Back
        </a>

        <a href="{{ route('portfolio.download') }}"
           class="text-sm bg-gray-800 text-white px-4 py-2 rounded hover:bg-black">
            Download CV (PDF)
        </a>
    </div>

</div>

</body>
</html>
