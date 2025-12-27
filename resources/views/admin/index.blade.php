@extends('layouts.app')

@section('content')
    <div class="glass overflow-hidden shadow-2xl sm:rounded-2xl">
        <div class="p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-heading font-bold text-gray-800">Student Management</h1>
                    <p class="text-gray-500 mt-1">Manage and organize your students efficiently.</p>
                </div>
                <button onclick="document.getElementById('createModal').classList.remove('hidden')"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transform transition-all hover:scale-105 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Student
                </button>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 bg-white/50 backdrop-blur-sm">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Student
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Contact
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($students as $student)
                            <tr class="hover:bg-white/60 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($student->photo)
                                                <img class="h-10 w-10 rounded-full object-cover border-2 border-indigo-100"
                                                    src="{{ asset('storage/' . $student->photo) }}" alt="">
                                            @else
                                                <div
                                                    class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-600 border-2 border-indigo-50">
                                                    {{ substr($student->prenom, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $student->prenom }}
                                                {{ $student->nom }}</div>
                                            <div class="text-xs text-gray-500">ID: #{{ $student->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $student->email }}</div>
                                    <div class="text-xs text-gray-500">{{ $student->tele }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                    <button onclick="openEditModal({{ $student }})"
                                        class="text-indigo-600 hover:text-indigo-900 font-bold hover:underline">Edit</button>
                                    <form action="{{ route('admin.destroy', $student->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to remove this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-400 hover:text-red-600 font-bold hover:underline">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div id="createModal"
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
        <div class="relative p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-white m-auto">
            <div class="mt-3">
                <h3 class="text-2xl leading-6 font-bold text-gray-900 text-center mb-6">Create New Student</h3>
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div><label class="block text-sm font-bold text-gray-700 mb-1">Nom</label><input type="text"
                                name="nom" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div><label class="block text-sm font-bold text-gray-700 mb-1">Prénom</label><input type="text"
                                name="prenom" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Email</label><input type="email"
                            name="email" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Téléphone</label><input type="text"
                            name="tele" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Mot de Passe (Optionnel)</label><input
                            type="password" name="password"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Photo</label><input type="file"
                            name="photo"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="document.getElementById('createModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition-colors shadow-lg">Create
                            Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div id="editModal"
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
        <div class="relative p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-white m-auto">
            <div class="mt-3">
                <h3 class="text-2xl leading-6 font-bold text-gray-900 text-center mb-6">Edit Student</h3>
                <form id="editForm" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div><label class="block text-sm font-bold text-gray-700 mb-1">Nom</label><input type="text"
                                name="nom" id="edit_nom" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div><label class="block text-sm font-bold text-gray-700 mb-1">Prénom</label><input type="text"
                                name="prenom" id="edit_prenom" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Email</label><input type="email"
                            name="email" id="edit_email" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Téléphone</label><input type="text"
                            name="tele" id="edit_tele" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Mot de Passe (laisser vide)</label><input
                            type="password" name="password"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Photo</label><input type="file"
                            name="photo"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition-colors shadow-lg">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(student) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editForm').action = "/admin/" + student.id;
            document.getElementById('edit_nom').value = student.nom;
            document.getElementById('edit_prenom').value = student.prenom;
            document.getElementById('edit_email').value = student.email;
            document.getElementById('edit_tele').value = student.tele;
        }
    </script>
@endsection