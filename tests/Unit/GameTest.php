<?php

declare(strict_types=1);

namespace Bowling\Tests\Unit;

use Bowling\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testShouldOneRollZeroPins(): void
    {
        $game = new Game();
        $game->roll(0);

        $this->assertEquals(
            0,
            $game->score()
        );
    }

    public function testShouldReturnCorrectScoreWithOnePin(): void
    {
        $game = new Game();
        $game->roll(1);

        $this->assertEquals(
            1,
            $game->score()
        );
    }

    public function testShouldReturnCorrectScoreFullOneGameWithSimplePoints(): void
    {
        $game = new Game();
        for ($i=0; $i<20; $i++) {
            $game->roll(1);
        }

        $this->assertEquals(
            20,
            $game->score()
        );
    }

    public function testShouldReturnCorrectScoreWithSpare(): void
    {
        $game = new Game();
        $game->roll(5);
        $game->roll(5);
        $game->roll(4);

        $this->assertEquals(
            18,
            $game->score()
        );
    }

    public function testShouldReturnCorrectScoreWithStrike(): void
    {
        $game = new Game();
        $game->roll(10);
        $game->roll(5);
        $game->roll(4);

        $this->assertEquals(
            28,
            $game->score()
        );
    }

    public function testShouldReturnPerfectGame(): void
    {
        $game = new Game();
        for ($i=0; $i<12; $i++) {
            $game->roll(10);
        }

        $this->assertEquals(
            300,
            $game->score()
        );
    }
}