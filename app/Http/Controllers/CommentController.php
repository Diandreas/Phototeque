<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        $images = Image::all();
        return view('comments.create', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'image_id' => 'required|exists:images,id',
        ]);

        Comment::create($request->all());

        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }

    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        $images = Image::all();
        return view('comments.edit', compact('comment', 'images'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'description' => 'required|string',
            'image_id' => 'required|exists:images,id',
        ]);

        $comment->update($request->all());

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }
}
