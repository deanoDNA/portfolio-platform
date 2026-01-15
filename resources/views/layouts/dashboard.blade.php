<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    @vite('resources/css/app.css')

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- IMPORTANT: Prevent modal flashing -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<!-- ================= TOP NAVBAR ================= -->
<header class="bg-white border-b h-14 flex items-center justify-between px-6">

    <span class="text-sm font-semibold text-gray-800">
        Portfolio Platform
    </span>

    <!-- USER INFO -->
    <div class="flex items-center gap-3">

        <div class="text-right leading-tight">
            <p class="text-sm font-medium text-gray-800">
                {{ auth()->user()->name }}
            </p>
            <p class="text-xs text-gray-500">
                {{ auth()->user()->email }}
            </p>
        </div>

        <!-- SMALL PHOTO (CLICKABLE) -->
        <div x-data="{ open:false }" class="relative">
            <div @click="open = true"
                 class="w-8 h-8 rounded-full overflow-hidden bg-gray-200 cursor-pointer">
                @if(isset($portfolio) && $portfolio->profile_photo)
                    <img src="{{ asset('storage/' . $portfolio->profile_photo) }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">
                        ?
                    </div>
                @endif
            </div>

            <!-- MODAL -->
            <div x-cloak
                 x-show="open"
                 x-transition
                 class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">

                <div @click.outside="open=false"
                     class="bg-white rounded shadow p-6 w-80">

                    <h3 class="text-sm font-semibold text-gray-800 mb-3">
                        Update Profile Photo
                    </h3>

                    <form method="POST"
                          action="{{ route('portfolio.updatePhoto') }}"
                          enctype="multipart/form-data">
                        @csrf

                        <input type="file"
                               name="profile_photo"
                               required
                               class="block w-full text-sm mb-4">

                        <div class="flex justify-end gap-2">
                            <button type="button"
                                    @click="open=false"
                                    class="px-3 py-1 text-sm border rounded">
                                Cancel
                            </button>

                            <button type="submit"
                                    class="px-3 py-1 text-sm bg-gray-800 text-white rounded">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</header>

<!-- ================= MAIN ================= -->
<div class="flex flex-1">

    <!-- ============ SIDEBAR ============ -->
    <aside class="w-64 bg-white border-r flex flex-col">

        <!-- PROFILE -->
        <div class="p-6 border-b text-center">
            <div x-data="{ open:false }" class="relative">

                <!-- BIG PHOTO -->
                <div @click="open=true"
                     class="w-28 h-28 mx-auto rounded-full overflow-hidden border bg-gray-100 mb-3 cursor-pointer">
                    @if(isset($portfolio) && $portfolio->profile_photo)
                        <img src="{{ asset('storage/' . $portfolio->profile_photo) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                            No Photo
                        </div>
                    @endif
                </div>

                <!-- MODAL -->
                <div x-cloak
                     x-show="open"
                     x-transition
                     class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">

                    <div @click.outside="open=false"
                         class="bg-white rounded shadow p-6 w-80">

                        <h3 class="text-sm font-semibold text-gray-800 mb-3">
                            Update Profile Photo
                        </h3>

                        <form method="POST"
                              action="{{ route('portfolio.updatePhoto') }}"
                              enctype="multipart/form-data">
                            @csrf

                            <input type="file"
                                   name="profile_photo"
                                   required
                                   class="block w-full text-sm mb-4">

                            <div class="flex justify-end gap-2">
                                <button type="button"
                                        @click="open=false"
                                        class="px-3 py-1 text-sm border rounded">
                                    Cancel
                                </button>

                                <button type="submit"
                                        class="px-3 py-1 text-sm bg-gray-800 text-white rounded">
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <p class="font-medium text-gray-800 text-sm">
                {{ $portfolio->full_name ?? auth()->user()->name }}
            </p>

            <p class="text-xs text-gray-500 mt-1">
                Portfolio Owner
            </p>
        </div>

        <!-- NAVIGATION -->
        <nav class="flex-1 p-4 text-sm space-y-1">

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded
               {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-medium' : 'hover:bg-gray-100' }}">
                Dashboard
            </a>

            <a href="{{ route('portfolio.step1') }}"
               class="block px-4 py-2 rounded
               {{ request()->routeIs('portfolio.*') ? 'bg-gray-200 font-medium' : 'hover:bg-gray-100' }}">
                My Portfolio
            </a>

            @if(isset($portfolio))
                <a href="{{ route('portfolio.public', $portfolio->id) }}"
                   class="block px-4 py-2 rounded hover:bg-gray-100">
                    View Portfolio
                </a>

                <a href="{{ route('portfolio.download') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-100">
                    Download CV
                </a>
            @endif
        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded text-red-600 hover:bg-gray-100 text-sm">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ============ CONTENT ============ -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

<!-- ================= FOOTER ================= -->
<footer class="bg-white border-t h-10 flex items-center justify-center text-xs text-gray-500">
    © {{ date('Y') }} Portfolio Platform
</footer>

</body>
</html>
