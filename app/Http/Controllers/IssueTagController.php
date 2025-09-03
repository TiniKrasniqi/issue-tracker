<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Http\Requests\SyncIssueTagsRequest;

class IssueTagController extends Controller
{
    public function sync(SyncIssueTagsRequest $request, Issue $issue)
    {
        $ids = $request->input('tag_ids', []);
        $issue->tags()->sync($ids);

        $issue->load('tags');
        return view('issues.partials.tag_pills', ['issue' => $issue])->render();
    }
}
