<?php

namespace blackJack;

require_once('ScoreConversionSet.php');
require_once('ScoreConversionRun.php');
class ScoreConversion implements ScoreConversionSet
{
    public const CARD_NUMS = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10,
        'A' => 1,
    ];

    public function __construct(private int $currentPoint)
    {
    }

    public function scoreConversion(array $drawCard): int
    {
        $cardNum = $drawCard[1];

        //2~9 = 数字通り、 10JQK = 10点、 A=1点、（２１を超えない限りは11点として扱う）
        if ($cardNum === 'A' && 10 >= $this->currentPoint) {
            return 11;
        }

        return self::CARD_NUMS[$cardNum];
    }
}
