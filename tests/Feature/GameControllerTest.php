<?php

use App\Models\Puzzle;
use App\Models\User;

test('can create game on first request', function () {
    $user = User::factory()->create();
    $puzzle = Puzzle::create([
        'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
        'letter_combination_id' => 1,
    ]);

    $response = $this->actingAs($user)->getJson(route('api:games.show', $puzzle->id));

    $response->assertSuccessful();
    $this->assertTrue($user->puzzles()->where('puzzle_id', $puzzle->id)->exists());
});

test('can retreive existing game', function () {
    $user = User::factory()->create();
    $puzzle = Puzzle::create([
        'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
        'letter_combination_id' => 1,
    ]);
    $user->puzzles()->attach($puzzle, ['found_words' => ['test']]);

    $response = $this->actingAs($user)->getJson(route('api:games.show', $puzzle->id));

    $response->assertSuccessful();
    $this->assertSame(['test'], $response->json()['game']['found_words']);
});

test('can update existing game', function () {
    $user = User::factory()->create();
    $puzzle = Puzzle::create([
        'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
        'letter_combination_id' => 1,
    ]);
    $user->puzzles()->attach($puzzle, ['found_words' => ['foo']]);

    $response = $this->actingAs($user)->postJson(route('api:games.update', $puzzle->id), [
        'found_words' => ['foo', 'bar', 'baz'],
    ]);

    $response->assertSuccessful();
    $this->assertSame(['foo', 'bar', 'baz'], $user->puzzles()->where('puzzle_id', $puzzle->id)->first()->game->found_words);
});
