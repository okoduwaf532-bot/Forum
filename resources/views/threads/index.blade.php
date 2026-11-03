<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div>
                <p class="mb-2 text-sm font-bold uppercase tracking-widest text-blue-600">Community forum</p>
                <h1 class="text-4xl font-black tracking-tight text-slate-950">Learn, share, build together.</h1>
                <p class="mt-3 max-w-2xl text-slate-500">A friendly place for developers to ask questions, exchange ideas, and solve problems together.</p>
            </div>
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('thread.create') }}" class="forum-button">+ Create a thread</a>
                @endif
            @endauth
        </div>

        <div class="grid gap-8 lg:grid-cols-[1fr_280px]">
            <section>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-900">Discussion spaces</h2>
                    <span class="text-sm text-slate-500">{{ $threads->count() }} {{ Str::plural('space', $threads->count()) }}</span>
                </div>
                <div class="space-y-4">
                    @forelse ($threads as $thread)
                        <a href="{{ route('thread.show', $thread) }}" class="forum-card group block p-6 transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
                            <div class="flex items-start gap-4">
                                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-xl text-blue-600">#</span>
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-col justify-between gap-2 sm:flex-row">
                                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600">{{ $thread->title }}</h3>
                                        <span class="text-sm text-slate-400">{{ $thread->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">{{ $thread->description }}</p>
                                    <div class="mt-4 flex items-center gap-4 text-xs font-semibold text-slate-400">
                                        <span>{{ $thread->topics_count }} {{ Str::plural('topic', $thread->topics_count) }}</span>
                                        <span>Started by {{ $thread->user?->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                                <span class="hidden text-slate-300 transition group-hover:translate-x-1 group-hover:text-blue-500 sm:block">→</span>
                            </div>
                        </a>
                    @empty
                        <div class="forum-card p-10 text-center text-slate-500">No discussion spaces have been created yet.</div>
                    @endforelse
                </div>
            </section>
            <aside class="forum-card h-fit bg-slate-900 p-6 text-white">
                <p class="text-sm font-bold uppercase tracking-widest text-blue-300">Welcome</p>
                <h2 class="mt-3 text-2xl font-bold">Be part of the conversation.</h2>
                <p class="mt-3 text-sm leading-6 text-slate-300">Ask thoughtful questions, share what you know, and help make development easier for everyone.</p>
                @guest
                    <a href="{{ route('register') }}" class="mt-6 inline-flex text-sm font-bold text-blue-300 hover:text-white">Join the community →</a>
                @endguest
            </aside>
        </div>
    </div>
</x-app-layout>