@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[70vh]">
        <div class="w-full max-w-md glass p-8 rounded-2xl shadow-xl animate-fade-in-up">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-heading font-bold text-gray-800">Welcome Back</h2>
                <p class="text-gray-600 mt-2">Sign in to access your account</p>
            </div>

            <!-- Google Sign In Section -->
            <div id="login-container" class="space-y-6">
                <div class="text-center">
                    <button id="google-signin-btn" type="button"
                        class="w-full flex items-center justify-center gap-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-4 rounded-xl shadow-sm transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-6 h-6"
                            alt="Google Logo">
                        <span>Sign in with Google</span>
                    </button>
                    <p id="error-message" class="text-red-500 text-sm mt-4 hidden"></p>
                </div>

                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-400 text-sm">Authorized Access Only</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-500">Authentication managed by Google Firebase</p>
                </div>
            </div>

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

                // Initialize Firebase
                const app = initializeApp(firebaseConfig);
                const auth = getAuth(app);
                const provider = new GoogleAuthProvider();

                const btn = document.getElementById('google-signin-btn');
                const errorMsg = document.getElementById('error-message');

                btn.addEventListener('click', async () => {
                    btn.disabled = true;
                    btn.classList.add('opacity-50', 'cursor-not-allowed');
                    errorMsg.classList.add('hidden');

                    try {
                        const result = await signInWithPopup(auth, provider);
                        const user = result.user;
                        const idToken = await user.getIdToken();

                        // Send to Backend
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
                            throw new Error(data.message || 'Login failed on server');
                        }

                    } catch (error) {
                        console.error('Login Error:', error);
                        errorMsg.textContent = "Authentication failed: " + error.message;
                        errorMsg.classList.remove('hidden');
                        btn.disabled = false;
                        btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                });
            </script>
        </div>
    </div>
@endsection