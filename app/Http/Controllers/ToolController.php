<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Role;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::with('role')->get();
        return view('minecraft.admin.tools.index', compact('tools'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('minecraft.admin.tools.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'modifier' => 'required|numeric|min:0',
        ]);

        $data = $request->only(['role_id', 'name', 'modifier']);
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('tools', 'public');
        }

        Tool::create($data);

        return redirect()->route('minecraft.admin.tools.index')->with('success', 'Tool created successfully!');
    }

    public function edit(Tool $tool)
    {
        $roles = Role::all();
        return view('minecraft.admin.tools.edit', compact('tool', 'roles'));
    }

    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'modifier' => 'required|numeric|min:0',
        ]);

        $data = $request->only(['role_id', 'name', 'modifier']);
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('tools', 'public');
        }

        $tool->update($data);

        return redirect()->route('minecraft.admin.tools.index')->with('success', 'Tool updated successfully!');
    }

    public function destroy(Tool $tool)
    {
        if ($tool->icon) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($tool->icon);
        }

        $tool->delete();

        return redirect()->route('minecraft.admin.tools.index')->with('success', 'Tool deleted successfully!');
    }
}
