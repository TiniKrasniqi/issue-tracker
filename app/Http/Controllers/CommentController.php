<?php

namespace App\Http\Controllers;
use App\Models\Issue;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Issue $issue, Request $request)
    {
        $comments = $issue->comments()
            ->latest()
            ->paginate(5); 

        $html = view('comments.partials.list', compact('comments'))->render();

        return response()->json([
            'html' => $html,
            'next_page_url' => $comments->nextPageUrl(),
        ]);
    }

    public function store(Issue $issue, StoreCommentRequest $request)
    {
        $comment = $issue->comments()->create($request->validated());
        return response(
            view('comments.partials.item', compact('comment'))->render(),
            201
        );
    }
}
