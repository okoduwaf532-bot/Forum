<x-app-layout>
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-6 text-sm text-slate-400"><a href="{{ route('home') }}" class="hover:text-blue-600">Forum</a> <span class="mx-2">/</span> <a href="{{ route('thread.show', $thread) }}" class="hover:text-blue-600">{{ $thread->title }}</a></div>

        <article class="forum-card overflow-hidden">
            <div class="border-b border-slate-100 bg-slate-50 px-6 py-5 sm:px-8">
                <h1 class="text-3xl font-black tracking-tight text-slate-950">{{ $topic->title }}</h1>
                <p class="mt-2 text-sm text-slate-500">Started by <span class="font-semibold text-slate-700">{{ $topic->user->name }}</span> · {{ $topic->created_at->diffForHumans() }}</p>
            </div>
            <div class="px-6 py-7 sm:px-8">
                <p class="whitespace-pre-line leading-7 text-slate-700">{{ $topic->body }}</p>

                @auth
                    @if (auth()->id() === $topic->user_id)
                        <a href="{{ route('topic.edit', $topic) }}" class="mt-6 inline-block text-sm font-semibold text-blue-600 hover:text-blue-800">Edit topic →</a>
                    @endif
                @endif
            </div>
        </article>

        <section class="mt-10">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-bold text-slate-900">Replies</h2>
                <span class="text-sm text-slate-500">{{ $topic->replies->count() }} {{ Str::plural('reply', $topic->replies->count()) }}</span>
            </div>
            @forelse ($topic->replies as $reply)
                <article class="forum-card mb-4 p-6">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">{{ strtoupper(substr($reply->user->name, 0, 1)) }}</span>
                        <div><p class="text-sm font-bold text-slate-800">{{ $reply->user->name }}</p><p class="text-xs text-slate-400">{{ $reply->created_at->diffForHumans() }}</p></div>
                    </div>
                    <p class="mt-4 whitespace-pre-line leading-7 text-slate-700">{{ $reply->body }}</p>
                    @auth
                        @if (auth()->id() === $reply->user_id)
                            <a href="{{ route('reply.edit', $reply) }}" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:text-blue-800">Edit reply →</a>
                        @endif
                    @endauth
                </article>
            @empty
                <div class="forum-card p-8 text-center text-slate-500">There are no replies yet. Start the conversation below.</div>
            @endforelse
        </section>

        @auth
            <section class="forum-card mt-8 p-6">
                <h2 class="text-xl font-bold text-slate-900">Add your reply</h2>
                <form method="POST" action="{{ route('reply.store', $topic) }}">
                    @csrf
                    <textarea name="body" rows="5" class="forum-input mt-4" placeholder="Share your thoughts..." required>{{ old('body') }}</textarea>
                    @error('body') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
                    <button type="submit" class="forum-button mt-4">Post reply</button>
                </form>
            </section>
        @endauth
    </div>
</x-app-layout>
