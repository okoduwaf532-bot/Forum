<x-app-layout>
	<div class="user-edit-page max-w-3xl mx-auto py-10 px-6">
		<h1 class="text-3xl font-bold mb-8 text-white drop-shadow-[0_2px_4px_rgba(15,23,42,0.65)]">User details</h1>

		<form method="POST" action="{{ route('users.update', $user) }}">
			@csrf
			@method('PUT')

			<div class="mb-6">
				<label for="name" class="block font-medium mb-2 text-white drop-shadow-[0_1px_3px_rgba(15,23,42,0.65)]">Name</label>
				<input id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-3" required>
				@error('name') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
			</div>

			<div class="mb-6">
				<label for="email" class="block font-medium mb-2 text-white drop-shadow-[0_1px_3px_rgba(15,23,42,0.65)]">Email</label>
				<input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-3" required>
				@error('email') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
			</div>

			<div class="mb-6">
				<label for="role" class="block font-medium mb-2 text-white drop-shadow-[0_1px_3px_rgba(15,23,42,0.65)]">Role</label>
				<select id="role" name="role" class="w-full border rounded p-3" required>
					<option value="user" @selected(old('role', $user->role) === 'user')>User</option>
					<option value="admin" @selected(old('role', $user->role) === 'admin')>Administrator</option>
				</select>
			</div>

			<p class="mb-6 text-sm text-white/90 drop-shadow-[0_1px_3px_rgba(15,23,42,0.55)]">Registered: {{ $user->created_at?->format('d-m-Y H:i') }}</p>
			<button type="submit" class="forum-button">Save changes</button>
			<a href="{{ route('users.index') }}" class="ml-4 text-white drop-shadow-[0_1px_3px_rgba(15,23,42,0.55)] hover:underline">Cancel</a>
		</form>

		<div class="mt-10 border-t border-slate-200 pt-8">
			<h2 class="text-xl font-bold text-white drop-shadow-[0_2px_4px_rgba(15,23,42,0.65)]">Set a temporary password</h2>
			<p class="mt-2 text-sm text-white/90 drop-shadow-[0_1px_3px_rgba(15,23,42,0.55)]">This replaces the current password. The user will be directed to change it after signing in.</p>

			<form method="POST" action="{{ route('users.password.update', $user) }}" class="mt-5 space-y-5">
				@csrf
				@method('PUT')

				<div>
					<label for="temporary_password" class="block font-medium mb-2 text-white drop-shadow-[0_1px_3px_rgba(15,23,42,0.65)]">Temporary password</label>
					<input id="temporary_password" type="password" name="password" class="w-full border rounded p-3" required autocomplete="new-password">
					@error('password') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
				</div>

				<div>
					<label for="temporary_password_confirmation" class="block font-medium mb-2 text-white drop-shadow-[0_1px_3px_rgba(15,23,42,0.65)]">Confirm temporary password</label>
					<input id="temporary_password_confirmation" type="password" name="password_confirmation" class="w-full border rounded p-3" required autocomplete="new-password">
				</div>

				<button type="submit" class="forum-button">Set temporary password</button>
			</form>
		</div>
	</div>
</x-app-layout>
