<?php

declare(strict_types=1);

namespace RunescapeXpCalculator\Exception;

use Exception;
use RunescapeXpCalculator\Enum\ExperienceLimit;

final class InvalidExperience extends Exception
{
    public static function forBelowMinimum(int $experience): self
    {
        return new self(sprintf('Given amount of experience [%d] is below the minimum of %d', $experience, ExperienceLimit::MIN->value));
    }

    public static function forAboveMaximum(int $experience): self
    {
        return new self(sprintf('Given amount of experience [%d] above the maximum of %d', $experience, ExperienceLimit::MAX->value));
    }
}
