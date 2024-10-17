<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KelolaAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Search user by name
        $users = User::where('name', 'LIKE', '%' . request()->search_user . '%')
            ->orderBy('name', 'asc')
            ->simplePaginate(5);
        return view('kelola.akun', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|max:100',
            'role' => 'required|string|max:100',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama harus diisi!',
            'email.required' => 'Email harus diisi!',
            'role.required' => 'Role harus diisi!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to user list with success message
        return redirect()->route('kelola.akun.index')->with('success', 'Berhasil Menambah Data Akun!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get user by id
        $user = User::findOrFail($id);
        return view('kelola.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Get user by id
        $user = User::findOrFail($id);
        return view('kelola.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'sometimes|required_if:old_email,' . $request->old_email . '|email|unique:users,email,' . $id . '|max:100',
            'password' => 'nullable|min:8',
        ], [
            'name.required' => 'Nama harus diisi!',
            'email.required' => 'Email harus diisi!',
            'role.required' => 'Role harus diisi!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        // Update user data
        $process = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email ? $request->email : User::findOrFail($id)->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : User::findOrFail($id)->password,
        ]);

        // Redirect to user list with success or failed message
        if ($process) {
            return redirect()->route('kelola.akun.index')->with('success', 'Berhasil Mengubah Data Akun!');
        } else {
            return redirect()->route('kelola.akun.index')->with('failed', 'Gagal Mengubah Data Akun!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Get user by id
        $user = User::findOrFail($id);
        $process = $user->delete();

        // Redirect to user list with success or failed message
        if ($process) {
            return redirect()->route('kelola.akun.index')->with('success', 'Berhasil Menghapus Data Akun!');
        } else {
            return redirect()->route('kelola.akun.index')->with('failed', 'Gagal Menghapus Data Akun!');
        }
    }

    /**
     * Login user
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * Login user authentication
     */
    public function loginAuth(Request $request)
    {
        // Validate email and password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Retrieve credentials from request
        $credentials = $request->only('email', 'password');

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            // Successful login, redirect to home
            return redirect()->route('home')->with('success', 'Berhasil Login!');
        } else {
            // Failed login, redirect back to login page with error
            return redirect()->route('login')->with('failed', 'Gagal Login!');
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil Logout!');
    }
}

