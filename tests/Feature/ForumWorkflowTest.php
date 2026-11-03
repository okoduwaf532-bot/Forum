<?php

use App\Models\Thread;
use App\Models\Topic;
use App\Models\User;

it('allows an admin to create a thread and users to add topics and replies', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($admin);

    $this->post('/thread', [
        'title' => 'My first thread',
        'description' => 'A thread description',
    ])->assertRedirect('/threads');

    $thread = Thread::first();
    expect($thread)->not->toBeNull()
        ->and($thread->title)->toBe('My first thread');

    $this->actingAs($user)->post('/thread/' . $thread->id . '/topic', [
        'title' => 'My first topic',
        'body' => 'A topic body',
    ])->assertSessionHas('success');

    $topic = Topic::first();
    expect($topic)->not->toBeNull()
        ->and($topic->title)->toBe('My first topic');

    $this->post('/topic/' . $topic->id . '/reply', [
        'body' => 'My reply body',
    ])->assertSessionHas('success');

    $this->assertDatabaseHas('replies', [
        'body' => 'My reply body',
        'user_id' => $user->id,
    ]);
});

it('does not allow a regular user to create a thread', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)
        ->post('/thread', ['title' => 'Not allowed', 'description' => 'Not allowed'])
        ->assertForbidden();
});

it('only allows admin users to access the admin page', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $this->actingAs($admin)
        ->get('/admin')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin')
        ->assertStatus(403);
});
