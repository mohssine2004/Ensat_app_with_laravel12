@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[80vh] text-center perspective-1000">
        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <h1 class="text-5xl md:text-8xl font-heading font-bold text-white mb-6 drop-shadow-2xl animate-fade-in-up transform transition-transform hover:scale-105 duration-500"
                style="text-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                Welcome to <br>
                <span
                    class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 via-orange-400 to-red-400 inline-block filter drop-shadow-lg float-3d">ENSAT
                    App</span>
            </h1>
            <p
                class="text-xl md:text-2xl text-white/90 mb-10 max-w-2xl mx-auto font-light leading-relaxed drop-shadow-lg animate-fade-in-up delay-100">
                Experience the next dimension of student management.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center animate-fade-in-up delay-200 perspective-1000">
                <a href="{{ route('login') }}"
                    class="tilt-container px-10 py-5 bg-white text-blue-600 font-bold rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] hover:shadow-[0_20px_60px_rgba(255,255,255,0.3)] transition-all transform flex items-center gap-3 justify-center border-b-4 border-blue-200">
                    <span class="text-lg">Get Started</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- 3D Decorative Elements -->
        <div class="absolute top-1/4 left-10 w-24 h-24 bg-white/10 rounded-full blur-xl animate-pulse delay-700"></div>
        <div class="absolute bottom-1/4 right-10 w-32 h-32 bg-purple-500/20 rounded-full blur-2xl animate-pulse delay-1000">
        </div>

        <!-- Features Section -->
        <div id="features"
            class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto px-6 animate-fade-in-up delay-300 perspective-1000">
            <div
                class="tilt-container glass p-8 rounded-3xl text-left transition-all duration-300 border border-white/40 shadow-2xl backdrop-blur-xl bg-white/10 hover:bg-white/20">
                <div
                    class="bg-gradient-to-br from-blue-400 to-blue-600 w-14 h-14 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg transform translate-z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.499 5.216 50.552 50.552 0 00-2.658.813m-15.482 0A50.55 50.55 0 0112 13.489a50.55 50.55 0 0112-1.686m-12 0c2.161 0 4.22-.095 6.183-.266" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3 drop-shadow-md">Secure Access</h3>
                <p class="text-blue-50 font-medium leading-relaxed">Enterprise-grade security with Google Sign-In and
                    role-based permissions.</p>
            </div>

            <div class="tilt-container glass p-8 rounded-3xl text-left transition-all duration-300 border border-white/40 shadow-2xl backdrop-blur-xl bg-white/10 hover:bg-white/20"
                style="transition-delay: 100ms;">
                <div
                    class="bg-gradient-to-br from-cyan-400 to-cyan-600 w-14 h-14 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3 drop-shadow-md">Student Profiles</h3>
                <p class="text-blue-50 font-medium leading-relaxed">Manage your personal information, contact details, and
                    academic records easily.</p>
            </div>

            <div class="tilt-container glass p-8 rounded-3xl text-left transition-all duration-300 border border-white/40 shadow-2xl backdrop-blur-xl bg-white/10 hover:bg-white/20"
                style="transition-delay: 200ms;">
                <div
                    class="bg-gradient-to-br from-teal-400 to-teal-600 w-14 h-14 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3 drop-shadow-md">Admin Tools</h3>
                <p class="text-blue-50 font-medium leading-relaxed">Powerful dashboard for administrators to oversee student
                    data and operations.</p>
            </div>
        </div>
    </div>
@endsection