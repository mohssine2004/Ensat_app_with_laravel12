@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[80vh] py-10">
        <div class="w-full max-w-2xl glass p-8 rounded-2xl shadow-xl animate-fade-in-up">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-heading font-bold text-gray-800">Create Account</h2>
                <p class="text-gray-600 mt-2">Join the ENSAT community today</p>
            </div>

            <div class="mb-8">
                <button id="google-signin-register-btn" type="button"
                    class="w-full flex items-center justify-center gap-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-4 rounded-xl shadow-sm transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-6 h-6"
                        alt="Google Logo">
                    <span>Sign up with Google</span>
                </button>
                <p id="register-error-message" class="text-red-500 text-sm mt-4 hidden"></p>

                <div class="relative flex py-4 items-center">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-400 text-sm">Or register with email</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                        <input id="nom" type="text" name="nom" value="{{ old('nom') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none bg-white/50 backdrop-blur-sm"
                            placeholder="Doe">
                    </div>
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                        <input id="prenom" type="text" name="prenom" value="{{ old('prenom') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none bg-white/50 backdrop-blur-sm"
                            placeholder="John">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tele" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input id="tele" type="text" name="tele" value="{{ old('tele') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none bg-white/50 backdrop-blur-sm"
                            placeholder="0600000000">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none bg-white/50 backdrop-blur-sm"
                            placeholder="john@example.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de Passe</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none bg-white/50 backdrop-blur-sm"
                        placeholder="••••••••">
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Photo de Profil</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="photo"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-indigo-300 border-dashed rounded-lg cursor-pointer bg-indigo-50 hover:bg-indigo-100 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-indigo-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag
                                    and drop</p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 2MB)</p>
                            </div>
                            <input id="photo" name="photo" type="file" class="hidden" accept="image/*" />
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg transform transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 mt-4">
                    Create Account
                </button>

                <p class="text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">Sign In</a>
                </p>
            </form>
        </div>
    </div>
    <!-- Firebase Script for Registration Page -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getAuth, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCeBns6M98nPAUy2Hp_hPdRtlxhDjnrTE0",
            authDomain: "ensatapp.firebaseapp.com",
            projectId: "ensatapp",
            storageBucket: "ensatapp.firebasestorage.app",
            messagingSenderId: "673970635896",
            appId: "1:673970635896:web:8b42ec63edd681fb7f598d"
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const provider = new GoogleAuthProvider();

        const btn = document.getElementById('google-signin-register-btn');
        const errorMsg = document.getElementById('register-error-message');

        if (btn) {
            btn.addEventListener('click', async () => {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
                errorMsg.classList.add('hidden');

                try {
                    const result = await signInWithPopup(auth, provider);
                    const user = result.user;
                    const idToken = await user.getIdToken();

                    const response = await fetch("{{ route('login.google') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id_token: idToken })
                    });

                    const data = await response.json();

                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        throw new Error(data.message || 'Registration failed on server');
                    }

                } catch (error) {
                    console.error('Registration Error:', error);
                    errorMsg.textContent = "Registration failed: " + error.message;
                    errorMsg.classList.remove('hidden');
                    btn.disabled = false;
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            });
        }
    </script>
@endsection