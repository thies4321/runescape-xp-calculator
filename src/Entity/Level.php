<?php

declare(strict_types=1);

namespace RunescapeXpCalculator\Entity;

use RunescapeXpCalculator\Enum\LevelLimit;

final readonly class Level
{
    private int $level;
    private int $experience;

    public function __construct(int $level, int $experience)
    {
        $this->level = $level;
        $this->experience = $experience;
    }

    public function getLevel(bool $virtual = false): int
    {
        return min(
            $this->level,
            $virtual ? LevelLimit::MAX_VIRTUAL->value : LevelLimit::MAX->value
        );
    }

    public function getExperience(): int
    {
        return $this->experience;
    }
}
