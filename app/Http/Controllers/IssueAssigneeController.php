<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Http\Requests\SyncIssueUsersRequest;

class IssueAssigneeController extends Controller
{
    public function sync(SyncIssueUsersRequest $request, Issue $issue)
    {
        $issue->users()->sync($request->input('user_ids', []));
        $issue->load('users');

        return view('issues.partials.assignee_pills', compact('issue'))->render();
    }
}