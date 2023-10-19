<?php

namespace poker;

#ゲームの操作盤
require_once('PokerCard.php');
require_once('RoleJudge.php');
require_once('CardTwoPokerRule.php');
require_once('CardThreePokerRule.php');
require_once('CardFivePokerRule.php');
require_once('ThreeCardWinner.php');
require_once('TwoCardWinner.php');
require_once('WinnerJudge.php');
require_once('WinnersRule.php');

class PokerGame
{
  private const THREE_CARD_POKER = 3;
  private const FIVE_CARD_POKER = 5;

  public function __construct(private array $card1, private array $card2)
  {
  }

  public function start(): array
  {

    $handRoles = [];
    //ランクに変換を行う処理
    foreach ([$this->card1, $this->card2] as $cards) {
      $pokerCard = array_map(fn ($card) => new PokerCard($card), $cards);
      //手札枚数で判別したルールで対象のインスタンス生成
      $rule = $this->getRule($cards);
      $winRule = $this->getWinRule($cards);
      //実行用のRoleJudgeクラスのインスタンス生成（対象ルールのクラスインスタンスを__constructに渡す）
      $cardRole = new RoleJudge($rule);
      //実行用のRoleJudge($rule)クラスのrankToRoleConvert($pokerCard)を実行する。
      $handRoles[] = $cardRole->rankToRoleConvert($pokerCard);
      //双方のプレイヤーの勝敗を判定
    }
    //勝敗ルールをWinnerJudgeクラスのコンストラクタへ渡す。
    $winnerJudge = new WinnerJudge($winRule);
    //対象の勝敗ルールで勝敗を判定
    $win = $winnerJudge->getWin($handRoles);

    return [$handRoles[0]['name'], $handRoles[1]['name'], $win];
  }

  public function getRule($cards)
  {
    //実行する用のインスタンスを生成する
    $rule = new CardTwoPokerRule();
    if (count($cards) === self::THREE_CARD_POKER) {
      $rule = new CardThreePokerRule();
    }
    if (count($cards) === self::FIVE_CARD_POKER) {
      $rule = new CardFivePokerRule();
    }

    return $rule;
  }

  public function getWinRule($cards)
  {
    //実行用のインスタンスを生成する
    $winRule =  new TwoCardWinner();
    if (count($cards) === self::THREE_CARD_POKER) {
      $winRule =  new ThreeCardWinner();
    }
    return $winRule;
  }
}
