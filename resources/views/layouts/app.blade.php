<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ENSAT App') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .preserve-3d {
            transform-style: preserve-3d;
        }

        .perspective-1000 {
            perspective: 1000px;
        }

        .tilt-card {
            transition: transform 0.1s ease;
        }

        .float-3d {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotateX(0deg) rotateY(0deg);
            }

            50% {
                transform: translateY(-20px) rotateX(5deg) rotateY(5deg);
            }

            100% {
                transform: translateY(0px) rotateX(0deg) rotateY(0deg);
            }
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-blue-500 via-cyan-500 to-teal-500 min-h-screen font-sans text-gray-900 antialiased selection:bg-cyan-500 selection:text-white">

    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <nav class="glass sticky top-0 z-50 shadow-sm border-b border-white/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center gap-3">
                            <div class="bg-white/20 p-1 rounded-lg backdrop-blur-sm">
                                <!-- Logo Image -->
                                <img src="{{ asset('storage/photos/image.png') }}" class="h-10 w-auto object-contain"
                                    alt="Logo">
                            </div>
                            <a href="{{ url('/') }}"
                                class="font-heading font-bold text-2xl text-white drop-shadow-md tracking-tight">ENSAT
                                App</a>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 relative">
                        @guest
                            <a href="{{ route('login') }}"
                                class="bg-white/90 hover:bg-white text-blue-600 font-bold py-2 px-6 rounded-lg shadow-sm transition-all transform hover:-translate-y-0.5 border border-white/50">
                                Log In
                            </a>
                        @else
                            <!-- Dropdown Trigger -->
                            <button id="profile-menu-btn"
                                class="flex items-center gap-2 focus:outline-none transition-transform hover:scale-105">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                                @else
                                    <div
                                        class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold border-2 border-white shadow-md">
                                        {{ substr(Auth::user()->prenom, 0, 1) }}
                                    </div>
                                @endif
                                <span class="hidden md:block font-medium text-gray-700 text-sm">
                                    {{ Auth::user()->prenom }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="profile-menu"
                                class="hidden absolute right-0 top-14 w-48 bg-white/90 backdrop-blur-md rounded-xl shadow-xl border border-white/50 py-2 origin-top-right transform transition-all duration-200 z-50">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm text-gray-900 font-bold">{{ Auth::user()->prenom }}
                                        {{ Auth::user()->nom }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                        Admin Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                        View Profile
                                    </a>
                                @endif

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @endguest
                    </div>

                    @auth
                        <script>
                            const menuBtn = document.getElementById('profile-menu-btn');
                            const menu = document.getElementById('profile-menu');
                            let isMenuOpen = false;

                            if (menuBtn) {
                                menuBtn.addEventListener('click', () => {
                                    isMenuOpen = !isMenuOpen;
                                    if (isMenuOpen) {
                                        menu.classList.remove('hidden');
                                    } else {
                                        menu.classList.add('hidden');
                                    }
                                });

                                // Close clicking outside
                                document.addEventListener('click', (e) => {
                                    if (!menuBtn.contains(e.target) && !menu.contains(e.target)) {
                                        menu.classList.add('hidden');
                                        isMenuOpen = false;
                                    }
                                });
                            }
                        </script>
                    @endauth
                </div>
            </div>
        </nav>

        {{-- Content --}}
        <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-6 glass border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-r shadow-md"
                    role="alert">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 glass border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-r shadow-md" role="alert">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="mt-auto glass border-t border-white/20 text-white/80 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm font-medium">
                <p>&copy; {{ date('Y') }} ENSAT App. Built with Laravel & Tailwind.</p>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('mousemove', (e) => {
            document.querySelectorAll('.tilt-container').forEach(card => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = ((y - centerY) / centerY) * -10; // Max rotation deg
                const rotateY = ((x - centerX) / centerX) * 10;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
        });

        // Reset on mouse leave
        document.querySelectorAll('.tilt-container').forEach(card => {
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
            });
        });
    </script>
</body>

</html>