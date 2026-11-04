<x-app-layout>
	<div class="max-w-3xl mx-auto py-10 px-6">
		<h1 class="text-3xl font-bold mb-8">Edit reply</h1>
		<form method="POST" action="{{ route('reply.update', $reply) }}">
			@csrf
			@method('PUT')
			<label for="body" class="block font-medium mb-2">Reply</label>
			<textarea id="body" name="body" rows="7" class="w-full border rounded p-3 mb-6" required>{{ old('body', $reply->body) }}</textarea>
			<button type="submit" class="forum-button">Save changes</button>
		</form>
	</div>
</x-app-layout>
