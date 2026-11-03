<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="forum-card overflow-hidden bg-slate-900 p-8 text-white sm:p-10">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-300">Forum Gang</p>
            <h1 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">Welcome back, {{ auth()->user()->name }}.</h1>
            <p class="mt-4 max-w-2xl leading-7 text-slate-300">You are signed in and ready to join the conversation, ask questions, and share what you know.</p>
            <a href="{{ route('home') }}" class="forum-button mt-6">Explore the forum</a>
        </div>
    </div>
</x-app-layout>
