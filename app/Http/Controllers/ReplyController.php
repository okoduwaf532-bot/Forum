<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $topic->replies()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Reply added successfully.');
    }

    public function edit(Reply $reply)
    {
        abort_unless($reply->user_id === auth()->id(), 403);

        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        abort_unless($reply->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $reply->update($validated);

        return back()->with('success', 'Reply updated successfully.');
    }
}
