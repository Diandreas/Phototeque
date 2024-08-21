<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserHasCommentController extends Controller
{
    public function index()
    {
        $userHasComments = User::with('comments')->get();
        return view('user_has_comments.index', compact('userHasComments'));
    }

    public function create()
    {
        $users = User::all();
        $comments = Comment::all();
        return view('user_has_comments.create', compact('users', 'comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'comment_id' => 'required|exists:comments,id',
        ]);

        $user = User::find($request->user_id);
        $user->comments()->attach($request->comment_id);

        return redirect()->route('user_has_comments.index')->with('success', 'User has comment created successfully.');
    }

    public function destroy($user_id, $comment_id)
    {
        $user = User::find($user_id);
        $user->comments()->detach($comment_id);

        return redirect()->route('user_has_comments.index')->with('success', 'User has comment deleted successfully.');
    }
}
