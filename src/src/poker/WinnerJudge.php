<?php

namespace poker;

require_once('WinnersRule.php');
//ルールによって実行するメソッド分岐用のクラス
class WinnerJudge
{
  //newクラスで生成したインスタンス情報のみを引数で受け取る場合は、インターフェイス用のクラスを作ってそこで受け取る！
  public function __construct(private WinnersRule $winRule)
  {
  }

  public function getWin(array $handRoles): int
  {
    return $this->winRule->getWin($handRoles);
  }
}
