<?php

namespace blackJack;

require_once('players.php');
require_once('DrawCard.php');

class Player3 implements players
{
    public array $drawCard = [];
    public int $point = 0;
    public array $handList = [];

    public function __construct(private DrawCard $drawCards)
    {
    }

    public function playersDraw(): array
    {
        $this->drawCard = $this->drawCards->drawCard();  //[$suit, $cardNum]
        //手札を保持、ドローしたカードを追加
        $this->handList[] = $this->drawCard;
        $this->playersPoint();
        return $this->drawCard;
    }

    public function playersPoint(): int
    {
        //まずはカードをポイント変換 ScoreConversionにAの変換判定の為に累計ポイントを渡す
        $scoreConversion =  new ScoreConversion($this->point);
        $ScoreConversionRun = new ScoreConversionRun($scoreConversion);
        //トータルポイントをドロー毎に加算していく
        $this->point += $ScoreConversionRun->scoreConversionRuns($this->drawCard);
        return $this->point;
    }
}
