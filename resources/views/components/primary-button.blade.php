<button {{ $attributes->merge(['type' => 'submit', 'class' => 'forum-button']) }}>
    <span>{{ $slot }}</span>
</button>
