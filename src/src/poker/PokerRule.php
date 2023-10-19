<?php

namespace poker;

interface PokerRule
{
  //お知らせ用に必ず実装するメソッドを記入する。
  public function rankToRoleConvert(array $cards);
}
