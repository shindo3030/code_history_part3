<?php

namespace blackJack;

interface BlackJackWinnersRule
{
    public function winner(array $pointArr);
}
