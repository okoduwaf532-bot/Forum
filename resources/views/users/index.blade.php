<x-app-layout>
	<div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
		<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
			<div>
				<p class="text-sm font-bold uppercase tracking-widest text-blue-300">Administration</p>
				<h1 class="mt-2 text-3xl font-black text-white">Community members</h1>
				<p class="mt-2 text-sm text-slate-300">Manage accounts and permissions without exposing passwords.</p>
			</div>
			<a href="{{ route('admin') }}" class="forum-button-secondary">Admin dashboard</a>
		</div>

		@if (session('success'))
			<p class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</p>
		@endif

		<div class="forum-card overflow-hidden">
			<div class="overflow-x-auto">
				<table class="w-full min-w-[640px] text-left">
				<thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
					<tr>
						<th class="px-6 py-4">Member</th>
						<th class="px-6 py-4">Email</th>
						<th class="px-6 py-4">Role</th>
						<th class="px-6 py-4 text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr class="border-t border-slate-100">
							<td class="px-6 py-4">
								<a class="flex items-center gap-3 font-semibold text-slate-800 hover:text-blue-600" href="{{ route('users.edit', $user) }}">
									<span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
									{{ $user->name }}
								</a>
							</td>
							<td class="px-6 py-4 text-sm text-slate-500">{{ $user->email }}</td>
							<td class="px-6 py-4"><span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold capitalize text-slate-600">{{ $user->role }}</span></td>
							<td class="px-6 py-4 text-right">
								<form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?');" class="inline">
									@csrf
									@method('DELETE')
									<a href="{{ route('users.edit', $user) }}" class="mr-3 text-sm font-semibold text-blue-600 hover:text-blue-800">Edit</a>
									<button class="text-sm font-semibold text-red-600 hover:text-red-800" type="submit">Delete</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
	</div>
</x-app-layout>
