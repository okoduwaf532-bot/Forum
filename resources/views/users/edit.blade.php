<x-app-layout>
	<div class="max-w-3xl mx-auto py-10 px-6">
		<h1 class="text-3xl font-bold mb-8">User details</h1>

		<form method="POST" action="{{ route('users.update', $user) }}">
			@csrf
			@method('PUT')

			<div class="mb-6">
				<label for="name" class="block font-medium mb-2">Name</label>
				<input id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-3" required>
				@error('name') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
			</div>

			<div class="mb-6">
				<label for="email" class="block font-medium mb-2">Email</label>
				<input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-3" required>
				@error('email') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
			</div>

			<div class="mb-6">
				<label for="role" class="block font-medium mb-2">Role</label>
				<select id="role" name="role" class="w-full border rounded p-3" required>
					<option value="user" @selected(old('role', $user->role) === 'user')>User</option>
					<option value="admin" @selected(old('role', $user->role) === 'admin')>Administrator</option>
				</select>
			</div>

			<p class="text-sm text-gray-500 mb-6">Registered: {{ $user->created_at?->format('d-m-Y H:i') }}</p>
			<button type="submit" class="bg-black text-white px-4 py-2 rounded">Save changes</button>
			<a href="{{ route('users.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
		</form>
	</div>
</x-app-layout>
