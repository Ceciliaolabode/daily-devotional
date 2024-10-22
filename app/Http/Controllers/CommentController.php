<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $comment = Comment::create($validated);

        return response()->json($comment, 201);
    }

    public function show($id)
    {
        return Comment::find($id);

    }
}


