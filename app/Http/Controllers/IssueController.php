<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Tag;
use App\Models\Project;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses   = ['open' => 'Open', 'in_progress' => 'In Progress', 'closed' => 'Closed'];
        $priorities = ['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'];
        $tags       = Tag::orderBy('name')->get(['id','name','color']);

        $issuesQuery = Issue::query()->with(['project', 'tags']);

        // Filters
        if ($status = request('status')) {
            $issuesQuery->where('status', $status);
        }
        if ($priority = request('priority')) {
            $issuesQuery->where('priority', $priority);
        }
        if ($tagId = request('tag')) {
            $issuesQuery->whereHas('tags', fn ($q) => $q->where('tags.id', $tagId));
        }

        // Using DataTables client-side → fetch all (you can switch to paginate if needed)
        $issues = $issuesQuery->latest()->get();

        return view('issues.index', [
            'issues'     => $issues,
            'statuses'   => $statuses,
            'priorities' => $priorities,
            'tags'       => $tags,
            'name1'      => 'Dashboard',
            'name2'      => 'Issues',
            'name3'      => 'List',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects   = Project::orderBy('name')->get(['id','name']);
        $statuses   = ['open' => 'Open', 'in_progress' => 'In Progress', 'closed' => 'Closed'];
        $priorities = ['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'];

        return view('issues.create', [
            'projects'   => $projects,
            'statuses'   => $statuses,
            'priorities' => $priorities,
            'prefillProjectId' => request('project_id'),
            'name1' => 'Dashboard', 'name2' => 'Issues', 'name3' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIssueRequest $request)
    {
        $issue = Issue::create($request->validated());

        return redirect()
            ->route('issues.show', $issue)
            ->with('success', 'Issue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue)
    {
        $issue->load(['project', 'tags']);

        return view('issues.show', [
            'issue' => $issue,
            'name1' => 'Dashboard',
            'name2' => 'Issues',
            'name3' => 'Details',
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        $projects   = Project::orderBy('name')->get(['id','name']);
        $statuses   = ['open' => 'Open', 'in_progress' => 'In Progress', 'closed' => 'Closed'];
        $priorities = ['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'];

        return view('issues.edit', [
            'issue'      => $issue,
            'projects'   => $projects,
            'statuses'   => $statuses,
            'priorities' => $priorities,
            'name1'      => 'Dashboard',
            'name2'      => 'Issues',
            'name3'      => 'Edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateIssueRequest $request, Issue $issue)
    {
        $issue->update($request->validated());

        return redirect()
            ->route('issues.show', $issue)
            ->with('success', 'Issue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        try {
            $issue->delete();

            return redirect()
                ->route('issues.index')
                ->with('success', 'Issue deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('issues.index')
                ->with('error', 'Failed to delete issue: ' . $e->getMessage());
        }
    }

}
