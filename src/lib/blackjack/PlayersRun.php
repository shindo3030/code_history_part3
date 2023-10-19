<?php

namespace blackJack;

require_once('DrawCard.php');
require_once('players.php');
class PlayersRun
{
    public function __construct(private Players $player)
    {
    }

    public function playerRun(): array
    {
        return $this->player->playersDraw();
    }
}
