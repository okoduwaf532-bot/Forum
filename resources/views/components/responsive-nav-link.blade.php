@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-xl px-4 py-3 text-start text-base font-semibold text-blue-700 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition'
            : 'block w-full rounded-xl px-4 py-3 text-start text-base font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
