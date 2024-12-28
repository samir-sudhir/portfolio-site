<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // List all projects
    public function index()
    {
        $projects = Project::all();
        return Helper::result('Projects retrieved successfully', 200, $projects);
    }

    // Show a specific project
    public function show(Project $project)
    {
        return Helper::result('Project retrieved successfully', 200, $project);
    }

    // Create a new project
    public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',  // Image validation
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('projects', 'public'); // Store in storage/app/public/projects directory
        $validated['image_path'] = $imagePath;  // Save the image path to store in the DB
    }

    // Create a new project with the validated data (including the image path)
    $project = Project::create($validated);

    // Return success response with the created project data
    return Helper::result("Project created successfully", 201, $project);
}

    // Update an existing project
public function update(Request $request, Project $project)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        // Store the new image
        $imagePath = $request->file('image')->store('project_images', 'public');
        $validated['image'] = $imagePath; // Add image path to validated data
    }

    $project->update($validated);

    return Helper::result('Project updated successfully', 200, $project);
}




    // Delete a project
    public function destroy(Project $project)
    {
        $project->delete();
        return Helper::result('Project deleted successfully', 200);
    }
}
