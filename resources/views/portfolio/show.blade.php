<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }} | Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

<!-- HEADER -->
<header class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center gap-6">

        <!-- Profile Photo (TOP LEFT) -->
        @if($portfolio && $portfolio->profile_image)
            <img src="{{ asset('storage/' . $portfolio->profile_image) }}"
                 class="w-20 h-20 rounded-full object-cover border">
        @else
            <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center text-2xl font-bold text-gray-700">
                {{ strtoupper(substr($user->username, 0, 1)) }}
            </div>
        @endif

        <!-- User Info -->
        <div>
            <h1 class="text-xl font-semibold">
                {{ $user->name }}
            </h1>
            <p class="text-sm text-gray-500">
                @{{ $user->username }}
            </p>

            @if($user->bio)
                <p class="text-sm text-gray-600 mt-1 max-w-xl">
                    {{ $user->bio }}
                </p>
            @endif
        </div>
    </div>
</header>

<!-- MAIN CONTENT -->
<main class="max-w-6xl mx-auto px-6 py-8 space-y-6">

    <!-- ABOUT -->
    <section class="bg-white border rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-3">About</h2>

        <p class="text-gray-700 leading-relaxed">
            {{ $portfolio->description ?? 'No description provided yet.' }}
        </p>
    </section>

    @if($skills->count())
<section class="bg-white border rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Skills</h2>

    <table class="w-full text-sm border-collapse">
        <thead>
            <tr class="border-b text-gray-600">
                <th class="text-left py-2">Skill</th>
                <th class="text-left">Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skills as $skill)
                <tr class="border-b">
                    <td class="py-2">{{ $skill->name }}</td>
                    <td>{{ $skill->level }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endif


    <!-- WEBSITE -->
    @if($portfolio && $portfolio->website)
        <section class="bg-white border rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-2">Website</h2>
            <a href="{{ $portfolio->website }}"
               target="_blank"
               class="text-indigo-600 hover:underline break-all">
                {{ $portfolio->website }}
            </a>
        </section>
    @endif

    <!-- FUTURE SECTIONS -->
    <section class="bg-white border rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-2">Experience / Projects</h2>
        <p class="text-gray-500 text-sm">
            Projects and work history will appear here.
        </p>
    </section>

</main>

<!-- FOOTER -->
<footer class="text-center text-sm text-gray-400 py-6">
    © {{ date('Y') }} {{ $user->name }} · Portfolio Platform
</footer>

</body>
</html>
