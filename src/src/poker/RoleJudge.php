<?php

namespace poker;

require_once('PokerCard.php');
require_once('PokerRule.php');
//ルールによって実行するメソッド分岐用のクラス
class RoleJudge
{
  //newクラスで生成したインスタンス情報のみを引数で受け取る場合は、インターフェイス用のクラスを作ってそこで受け取る！
  public function __construct(private PokerRule $rule)
  {
  }
  //$pokerCards　は　PokerCardのインスタンスプロパティを受け取った引数なのでテストの際は注意！
  public function rankToRoleConvert(array $pokerCards): array
  {
    //ruleは [CardTwoPokerRuleクラス],[CardTwoPokerRuleクラス] のどちらかが入る
    return $this->rule->rankToRoleConvert($pokerCards);
  }
}
