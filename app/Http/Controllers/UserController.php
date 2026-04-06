<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view daftar-akun', only: ['index']),
            new Middleware('permission:create akun', only: ['create', 'store']),
            new Middleware('permission:edit akun', only: ['edit', 'update']),
            new Middleware('permission:delete akun', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $roles = Role::orderBy('name')->get();
        return view('admin.akun.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.akun.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:3|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'nullable|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.akun.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::find($request->role);
        if ($role) {
            $user->assignRole($role);
        }

        return redirect()->route('admin.akun.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name')->get();
        $userRole = $user->roles->first();

        return view('admin.akun.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:3|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'nullable|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.akun.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        // Sync role: jika role diisi, assign; jika tidak, hapus semua role
        if ($request->filled('role')) {
            $role = Role::find($request->role);
            if ($role) {
                $user->syncRoles([$role]);
            }
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('admin.akun.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function resetPasswordForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.akun.reset-password', compact('user'));
    }

    /**
     * Reset the specified user password.
     */
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.akun.index')->with('success', 'Password berhasil direset.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Cegah menghapus akun sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.akun.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
