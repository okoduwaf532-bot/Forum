<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-6 text-sm text-slate-400"><a href="{{ route('home') }}" class="hover:text-blue-600">Forum</a> <span class="mx-2">/</span> {{ $thread->title }}</div>
        <div class="forum-card mb-8 bg-slate-900 p-8 text-white">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-300">Discussion space</p>
            <h1 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">{{ $thread->title }}</h1>
            <p class="mt-4 max-w-3xl leading-7 text-slate-300">{{ $thread->description }}</p>
        </div>

        @auth
            <div class="forum-card mb-8 p-6">
                <h2 class="text-xl font-bold text-slate-900">Start a conversation</h2>
                <p class="mt-1 text-sm text-slate-500">Share a question, idea, or useful experience with the community.</p>
                <form method="POST" action="{{ route('topic.store', $thread) }}" class="mt-5 grid gap-4">
                    @csrf
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="What would you like to discuss?" class="forum-input" required>
                    <textarea name="body" rows="4" placeholder="Add some context..." class="forum-input" required>{{ old('body') }}</textarea>
                    @error('title') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    @error('body') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    <div><button type="submit" class="forum-button">Publish topic</button></div>
                </form>
            </div>
        @endauth

        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-900">Latest discussions</h2>
            <span class="text-sm text-slate-500">{{ $topics->count() }} {{ Str::plural('topic', $topics->count()) }}</span>
        </div>
        <div class="space-y-3">
            @forelse ($topics as $topic)
                <a href="{{ route('topic.show', [$thread, $topic]) }}" class="forum-card group block p-5 transition hover:border-blue-200 hover:shadow-md">
                    <div class="flex items-start gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-bold text-blue-600">{{ strtoupper(substr($topic->user->name, 0, 1)) }}</span>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-col justify-between gap-1 sm:flex-row">
                                <h3 class="font-bold text-slate-900 group-hover:text-blue-600">{{ $topic->title }}</h3>
                                <span class="text-xs text-slate-400">{{ $topic->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">{{ Str::limit($topic->body, 180) }}</p>
                            <p class="mt-3 text-xs font-semibold text-slate-400">By {{ $topic->user->name }} · {{ $topic->replies_count }} {{ Str::plural('reply', $topic->replies_count) }}</p>
                        </div>
                        <span class="text-slate-300 transition group-hover:translate-x-1 group-hover:text-blue-500">→</span>
                    </div>
                </a>
            @empty
                <div class="forum-card p-10 text-center text-slate-500">No topics yet. Be the first to start a conversation.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>