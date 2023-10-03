<?php

declare(strict_types=1);

namespace RunescapeXpCalculator\Service;

use RunescapeXpCalculator\Entity\Level;
use RunescapeXpCalculator\Enum\ExperienceLimit;
use RunescapeXpCalculator\Enum\LevelLimit;
use RunescapeXpCalculator\Exception\InvalidExperience;
use RunescapeXpCalculator\Exception\InvalidLevel;
use RunescapeXpCalculator\Mapping\ExperienceMapping;

final class LevelService
{
    private ExperienceMapping $mapping;

    public function __construct(?ExperienceMapping $mapping = null)
    {
        $this->mapping = $mapping ?? new ExperienceMapping();
    }

    /**
     * @throws InvalidExperience
     */
    private function validateExperience(int $experience): void
    {
        if ($experience < ExperienceLimit::MIN->value) {
            throw InvalidExperience::forBelowMinimum($experience);
        }

        if ($experience > ExperienceLimit::MAX->value) {
            throw InvalidExperience::forAboveMaximum($experience);
        }
    }

    /**
     * @throws InvalidLevel
     */
    private function validateLevel(int $level): void
    {
        if ($level < LevelLimit::MIN->value) {
            throw InvalidLevel::forBelowMinimum($level);
        }

        if ($level > LevelLimit::MAX_VIRTUAL->value) {
            throw InvalidLevel::forAboveMaximum($level);
        }
    }

    /**
     * @throws InvalidExperience
     */
    public function getForExperience(int $experience): Level
    {
        $this->validateExperience($experience);

        $currentLevel = 1;
        foreach ($this->mapping->get() as $level => $exp) {
            if ($experience >= $exp) {
                $currentLevel = $level;
                continue;
            }

            break;
        }

        return new Level($currentLevel, $experience);
    }

    /**
     * @throws InvalidLevel
     */
    public function getForLevel(int $level): Level
    {
        $this->validateLevel($level);

        return new Level($level, $this->mapping->get()[$level]);
    }
}
