<?php

namespace RunescapeXpCalculator\Mapping;

use RunescapeXpCalculator\Enum\ExperienceLimit;

final readonly class ExperienceMapping
{
    private array $mapping;

    public function __construct()
    {
        $total = ExperienceLimit::MIN->value;
        $experience = [1 => $total];

        for ($level = 2; $level <= 126; $level++) {
            $total += floor(($level - 1) + 300 * pow(2, (($level - 1) / 7))) / 4;
            $experience[$level] = (int) floor($total);
        }

        $experience[127] = ExperienceLimit::MAX->value;

        $this->mapping = $experience;
    }

    public function get(): array
    {
        return $this->mapping;
    }
}
