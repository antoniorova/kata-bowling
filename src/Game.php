<?php

declare(strict_types=1);

namespace Bowling;

class Game
{
    private const FIRST_ROLL = 0;
    private const MAX_ROLL = 21;
    private const DEFAULT_PIN = 0;
    private const MAX_FRAMES = 10;
    private const SPARE_POINTS = 10;
    private const STRIKE_POINTS = 10;

    /** @var array<int, int>  */
    private array $rolls;
    private int $currentRoll = 0;

    public function __construct()
    {
        $this->rolls = array_fill(
            self::FIRST_ROLL,
            self::MAX_ROLL,
            self::DEFAULT_PIN
        );
    }

    public function roll(int $pins): void
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    public function score(): int
    {
        $score = 0;
        $currentRoll = 0;
        for ($frame = 0; $frame < self::MAX_FRAMES; $frame++) {
            if ($this->isSpare($currentRoll)) {
                $score += self::SPARE_POINTS + $this->rolls[$currentRoll + 2];
                $currentRoll += 2;
                continue;
            }
            if ($this->isStrike($currentRoll)) {
                $score += self::STRIKE_POINTS + $this->rolls[$currentRoll + 1] + $this->rolls[$currentRoll + 2];
                $currentRoll++;
                continue;
            }
            $score += $this->rolls[$currentRoll] + $this->rolls[$currentRoll + 1];
            $currentRoll += 2;
        }

        return $score;
    }

    private function isSpare(int $currentRoll): bool
    {
        return $this->rolls[$currentRoll] + $this->rolls[$currentRoll + 1] === self::SPARE_POINTS;
    }

    private function isStrike(int $currentRoll): bool
    {
        return $this->rolls[$currentRoll] === self::STRIKE_POINTS;
    }
}
