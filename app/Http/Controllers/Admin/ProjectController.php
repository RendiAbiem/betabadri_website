<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('pages/admins.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('pages/admins.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'category'    => 'required',
            'description' => 'required',
            'details'     => 'required',
            'image'       => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('projects', 'public');

        Project::create([
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'details'     => $request->details,
            'image'       => $path,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan');
    }

    public function edit(Project $project)
    {
        return view('pages/admins.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'       => 'required',
            'category'    => 'required',
            'description' => 'required',
            'details'     => 'required',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diupdate');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dihapus');
    }
}
