<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
            'role'     => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.akun.index')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::findById($request->role);
        $user->assignRole($role);

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
            'role'     => 'required|exists:roles,id',
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

        $role = Role::findById($request->role);
        $user->syncRoles([$role]);

        return redirect()->route('admin.akun.index')
            ->with('success', 'User berhasil diperbarui.');
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

        return response()->json(['status' => true, 'message' => 'Password berhasil direset.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'User tidak ditemukan.',
            ], 404);
        }

        // Cegah menghapus akun sendiri
        if ($user->id === auth()) {
            return response()->json([
                'status'  => false,
                'message' => 'Tidak dapat menghapus akun sendiri.',
            ], 403);
        }

        $user->delete();

        return response()->json([
            'status'  => true,
            'message' => 'User berhasil dihapus.',
        ]);
    }
}
