<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::with('user')
            ->withCount('topics')
            ->latest()
            ->get();

        return view('threads.index', compact('threads'));
    }

    public function show(Thread $thread)
    {
        $topics = $thread->topics()
            ->with('user')
            ->withCount('replies')
            ->latest()
            ->get();

        return view('threads.show', compact('thread', 'topics'));
    }

    public function create()
    {
        return view('threads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Thread::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()
            ->route('threads.index')
            ->with('success', 'Thread created successfully.');
    }
}