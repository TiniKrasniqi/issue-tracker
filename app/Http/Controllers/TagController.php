<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')->get(['id','name','color']);

        return view('tags.index', [
            'tags'  => $tags,
            'name1' => 'Dashboard',
            'name2' => 'Tags',
            'name3' => 'List',
        ]);
    }

    public function store(StoreTagRequest $request)
    {
        Tag::create($request->validated());

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag created successfully.');
    }
}
