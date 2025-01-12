<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    public function index(Request $request)
    {
        // Jika permintaan datang dari API, kembalikan JSON
        if ($request->is('api/*')) {
            $tools = Tool::with('role')->get();
            return response()->json($tools); // Return as JSON
        }

        // Jika permintaan datang dari rute admin, kembalikan view
        if ($request->is('minecraft/admin/*')) {
            $roles = Role::all();
            return view('minecraft.admin.tools.index');
        }

        // Default respons untuk keamanan
        abort(404, 'Not Found');
    }

    // Get roles for dropdown
    public function roles()
    {
        $roles = Role::all();
        return response()->json($roles); // Return as JSON
    }


    // Store a new tool
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'modifier' => 'required|numeric|min:0',
        ]);

        // Ambil data yang diinginkan dari request
        $data = $request->only(['role_id', 'name', 'modifier']);

        // Simpan file icon jika diunggah
        if ($request->hasFile('icon')) {
            // Simpan file di 'storage/app/public/images/tools'
            $data['icon'] = $request->file('icon')->store('images/tools', 'public');
        }

        // Simpan data Tool beserta path file
        $tool = Tool::create($data);

        return response()->json($tool, 201); // Kembalikan respons JSON
    }


    // Update an existing tool
    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'modifier' => 'required|numeric|min:0',
        ]);

        $data = $request->only(['role_id', 'name', 'modifier']);
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($tool->icon) {
                Storage::disk('public')->delete($tool->icon);
            }
            $data['icon'] = $request->file('icon')->store('images/tools', 'public');
        }

        $tool->update($data);

        return response()->json($tool); // Return updated tool
    }

    // Delete a tool
    public function destroy(Tool $tool)
    {
        if ($tool->icon) {
            Storage::disk('public')->delete($tool->icon);
        }

        $tool->delete();

        return response()->json(['message' => 'Tool deleted successfully.'], 200);
    }
}
