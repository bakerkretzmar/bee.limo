<?php

namespace Tests\Unit\Http\Controllers;

use App\Puzzle;
use App\User;
use Tests\TestCase;

class GameControllerTest extends TestCase
{
    /** @test */
    public function can_create_game_on_first_request()
    {
        $user = factory(User::class)->create();
        $puzzle = Puzzle::create([
            'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
            'letter_combination_id' => 1,
        ]);

        $response = $this->actingAs($user)->getJson(route('api:game', $puzzle->id));

        $response->assertSuccessful();
        $this->assertTrue($user->puzzles()->where('puzzle_id', $puzzle->id)->exists());
    }

    /** @test */
    public function can_retreive_existing_game()
    {
        $user = factory(User::class)->create();
        $puzzle = Puzzle::create([
            'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
            'letter_combination_id' => 1,
        ]);
        $user->puzzles()->attach($puzzle, ['found_word_ids' => ['test']]);

        $response = $this->actingAs($user)->getJson(route('api:game', $puzzle->id));

        $response->assertSuccessful();
        $this->assertSame(['test'], $response->json()['game']['found_word_ids']);
    }
}
