<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    // Menampilkan semua role untuk pengguna di halaman minecraft.story
    public function userIndex()
    {
        $roles = Role::all();  // Ambil semua data role
        return view('minecraft.story.index', compact('roles'));  // Kembalikan tampilan untuk user di minecraft.story
    }

    public function show(Role $role)
    {
        // Ambil tools dan locations berdasarkan role
        $tools = $role->tools; // Relasi tools dengan role
        $locations = $role->locations; // Relasi locations dengan role

        // Kirim semua data ke view
        return view('minecraft.story.show', compact('role', 'tools', 'locations'));
    }

    // CRUD untuk Admin
    public function index(Request $request)
    {
        // Jika permintaan datang dari API, kembalikan JSON
        if ($request->is('api/*')) {
            $roles = Role::all();
            return response()->json(['data' => $roles]);
        }

        // Jika permintaan datang dari rute admin, kembalikan view
        if ($request->is('minecraft/admin/*')) {
            $roles = Role::all();
            return view('minecraft.admin.roles.index', compact('roles'));
        }

        // Default respons untuk keamanan
        abort(404, 'Not Found');
    }

    public function create()
    {
        return view('minecraft.admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('roles', 'public');
        }

        Role::create($data);

        return redirect()->route('minecraft.admin.roles.index')->with('success', 'Role created successfully!');
    }

    public function edit(Role $role)
    {
        return view('minecraft.admin.roles.edit', compact('role'));
    }



    public function update(Request $request, Role $role)
    {
        Log::info('Incoming Request:', $request->all()); // Log semua data request

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Log::info('Validated Data:', $validatedData); // Log data setelah validasi

        $data = $request->only(['name', 'description']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('roles', 'public');
        }

        Log::info('Final Update Data:', $data); // Log data final untuk update

        $role->update($data);

        return response()->json([
            'message' => 'Role updated successfully!',
            'role' => $role,
        ]);
    }


    public function destroy(Role $role)
    {
        if ($role->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($role->image);
        }

        $role->delete();

        return redirect()->route('minecraft.admin.roles.index')->with('success', 'Role deleted successfully!');
    }
}
