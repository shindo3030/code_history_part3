<?php

//C7 =>['7']
//H3 S10 DA =>['3','10','A']
//J,Q,Kは11,12,13とする
function convertToNumber(...$cards)
{
  return array_map(function ($card) {
    return substr($card, 1, strlen($card) - 1);
  }, $cards);
}

//アロー関数
// return array_map(fn ($card) => substr($card, 1, strlen($card) - 1), $cards);
