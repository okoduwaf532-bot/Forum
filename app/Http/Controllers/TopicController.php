<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function show(Thread $thread, Topic $topic)
    {
        abort_unless($topic->thread_id === $thread->id, 404);

        $topic->load(['user', 'replies.user']);

        return view('topics.show', compact('thread', 'topic'));
    }

    public function store(Request $request, Thread $thread)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $thread->topics()->create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Topic created successfully.');
    }

    public function edit(Topic $topic)
    {
        abort_unless($topic->user_id === auth()->id(), 403);

        return view('topics.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        abort_unless($topic->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $topic->update($validated);

        return redirect()
            ->route('thread.show', $topic->thread_id)
            ->with('success', 'Topic updated successfully.');
    }
}