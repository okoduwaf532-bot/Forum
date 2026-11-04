<button {{ $attributes->merge(['type' => 'button', 'class' => 'forum-button-secondary']) }}>
    <span>{{ $slot }}</span>
</button>
