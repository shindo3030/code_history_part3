<?php

namespace poker;

interface WinnersRule
{
  public function getWin(array $handRoles);
}
