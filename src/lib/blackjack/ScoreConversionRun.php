<?php

namespace blackJack;

require_once('ScoreConversion.php');
require_once('ScoreConversionSet.php');

class ScoreConversionRun
{
    public function __construct(private ScoreConversion $scoreConversion)
    {
    }

    public function scoreConversionRuns(array $drawCard): int
    {
        return $this->scoreConversion->scoreConversion($drawCard);
    }
}
