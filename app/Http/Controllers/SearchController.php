<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $issues = Issue::query()
            ->with('project')
            ->when($q !== '', fn($qq) => $qq->where(fn($w) => $w
                ->where('title','like',"%{$q}%")
                ->orWhere('description','like',"%{$q}%")))
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'issues_page');

        $projects = Project::query()
            ->withCount('issues')
            ->when($q !== '', fn($qq) => $qq->where(fn($w) => $w
                ->where('name','like',"%{$q}%")
                ->orWhere('description','like',"%{$q}%")))
            ->orderBy('name')
            ->paginate(5, ['*'], 'projects_page');

        $tags = Tag::query()
            ->when($q !== '', fn($qq) => $qq->where('name','like',"%{$q}%"))
            ->orderBy('name')
            ->paginate(10, ['*'], 'tags_page'); 

        $html = view('search.partials.results', compact('issues','projects','tags'))->render();

        return response()->json(['html' => trim($html)]);
    }
}
