<?php

namespace blackJack;

require_once('Player1.php');
require_once('Deler.php');

require_once('BlackJackWinnersRule.php');
require_once('BlackJackWinnersBeginnerRule.php');


class BlackJackWinnersJudge
{
    public function __construct(private BlackJackWinnersRule $winnersRule)
    {
    }
    public function winnersJudgeRun(array $pointArr): string
    {
        return $this->winnersRule->winner($pointArr);
    }
}
