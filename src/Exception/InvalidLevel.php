<?php

declare(strict_types=1);

namespace RunescapeXpCalculator\Exception;

use Exception;
use RunescapeXpCalculator\Enum\LevelLimit;

final class InvalidLevel extends Exception
{
    public static function forBelowMinimum(int $level): self
    {
        return new self(sprintf('Given level [%d] is below the minimum of %d', $level, LevelLimit::MIN->value));
    }

    public static function forAboveMaximum(int $level): self
    {
        return new self(sprintf('Given level [%d] above the maximum of %d', $level, LevelLimit::MAX->value));
    }
}
