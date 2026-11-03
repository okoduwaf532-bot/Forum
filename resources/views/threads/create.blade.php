<x-app-layout>
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-6 text-sm text-slate-300">
            <a href="{{ route('home') }}" class="font-medium hover:text-white">Forum</a>
            <span class="mx-2">/</span>
            Create a thread
        </div>

        <div class="forum-card p-6 sm:p-8">
            <div class="mb-8">
                <p class="text-sm font-bold uppercase tracking-widest text-blue-600">Administration</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950">Create a new thread</h1>
                <p class="mt-3 text-sm leading-6 text-slate-500">Create a discussion space where your community can share topics and replies.</p>
            </div>

            <form method="POST" action="{{ route('thread.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-bold text-slate-800">Thread title</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}"
                           placeholder="For example: Laravel"
                           class="forum-input" required>
                    @error('title')
                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-slate-800">Description</label>
                    <textarea id="description" name="description" rows="5"
                              placeholder="Explain what members can discuss in this space."
                              class="forum-input" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                    <a href="{{ route('home') }}" class="forum-button-secondary">Cancel</a>
                    <button type="submit" class="forum-button">Create thread</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
