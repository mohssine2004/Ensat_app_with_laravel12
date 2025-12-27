<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.index', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'tele' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:6', // Password is now optional
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
        }
        User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'tele' => $validated['tele'],
            'email' => $validated['email'],
            'password' => $validated['password'] ?? null, // Handle null password
            'photo' => $path,
            'role' => 'student',
        ]);
        return redirect()->route('admin.index')->with('success', 'Student created successfully.');
    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'tele' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6', // Optional on update
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            $student->photo = $request->file('photo')->store('photos', 'public');
        }
        $student->nom = $validated['nom'];
        $student->prenom = $validated['prenom'];
        $student->tele = $validated['tele'];
        $student->email = $validated['email'];
        if (!empty($validated['password'])) {
            $student->password = $validated['password'];
        }
        $student->save();
        return redirect()->route('admin.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = User::findOrFail($id);
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }
        $student->delete();

        return redirect()->route('admin.index')->with('success', 'Student deleted successfully.');
    }
}
