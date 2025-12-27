@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="glass overflow-hidden shadow-2xl sm:rounded-2xl">
            <div class="relative h-32 bg-gradient-to-r from-indigo-500 to-purple-500">
                <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Photo"
                            class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    @else
                        <div
                            class="w-32 h-32 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 text-4xl font-bold border-4 border-white shadow-lg">
                            {{ substr(Auth::user()->prenom, 0, 1) }}{{ substr(Auth::user()->nom, 0, 1) }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="px-6 pt-20 pb-8 text-center">
                <h1 class="text-4xl font-heading font-bold text-gray-800 mb-2">Welcome to your account!</h1>
                <p class="text-gray-500 font-medium">Student at ENSAT</p>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto text-left">
                    <div
                        class="bg-white/60 p-6 rounded-xl border border-white shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
                        <div class="bg-indigo-100 p-3 rounded-full text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-xs uppercase text-gray-500 font-bold tracking-wider">Email
                                Address</span>
                            <span class="font-semibold text-gray-800 break-all">{{ Auth::user()->email }}</span>
                        </div>
                    </div>

                    <div
                        class="bg-white/60 p-6 rounded-xl border border-white shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
                        <div class="bg-purple-100 p-3 rounded-full text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-xs uppercase text-gray-500 font-bold tracking-wider">Phone Number</span>
                            <span class="font-semibold text-gray-800">{{ Auth::user()->tele }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 bg-white/60 p-8 rounded-2xl shadow-sm text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="tele" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="tele" id="tele" value="{{ Auth::user()->tele }}" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all outline-none">
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Profile Photo</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-transform transform hover:-translate-y-0.5">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection