<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project; 
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = \App\Models\Project::withCount('issues')
            ->latest()
            ->paginate(10);

        return view('projects.index', [
            'projects' => $projects,
            'name1' => 'Dashboard',
            'name2' => 'Projects',
            'name3' => 'List',
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('projects.create', [
            'name1' => 'Dashboard',
            'name2' => 'Projects',
            'name3' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(StoreProjectRequest $request)
    {
        $project = new Project($request->validated());
        $project->owner_id = auth()->id();
        $project->save();

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load([
            'issues.tags' => fn ($q) => $q->orderBy('name'),
        ]);

        return view('projects.show', [
            'project' => $project,
            'issues'  => $project->issues,
            'name1'   => 'Dashboard',
            'name2'   => 'Projects',
            'name3'   => 'Details',
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Project $project)
    {
        Gate::authorize('update', $project);
        return view('projects.edit', [
            'project' => $project,
            'name1'   => 'Dashboard',
            'name2'   => 'Projects',
            'name3'   => 'Edit',
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        Gate::authorize('update', $project);
        $project->update($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Gate::authorize('delete', $project);
        try {
            $project->delete();

            return redirect()
                ->route('projects.index')
                ->with('success', 'Project deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('projects.index')
                ->with('error', 'Failed to delete project: ' . $e->getMessage());
        }
    }

}
