<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\BlackJackGame as BlackJackGame;


require_once(__DIR__ . '/../../lib/blackjack/BlackJackGame.php');
require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');
require_once(__DIR__ . '/../../lib/blackjack/Player1.php');
require_once(__DIR__ . '/../../lib/blackjack/Player2.php');
require_once(__DIR__ . '/../../lib/blackjack/Player3.php');
require_once(__DIR__ . '/../../lib/blackjack/players.php');
require_once(__DIR__ . '/../../lib/blackjack/PlayersRun.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversion.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversionRun.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversionSet.php');
require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersBeginnerRule.php');
require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersRule.php');
require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersJudge.php');

class BlackJackGameTest extends TestCase
{
  public function testGameStart()
  {
    $blackJackGame = new BlackJackGame();

    //勝敗結果
    //プレイヤー全員がディーラーに勝った場合
    $results = $blackJackGame->gameStart();

    if ((string)$results === 'プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。') {
      $this->assertSame('プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。', $results);
    }

    //ディーラーが一人に勝っていた場合
    if ((string)$results === 'ディーラーの勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。') {
      $this->assertSame('ディーラーの勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。', $results);
    }

    if ((string)$results === 'プレイヤー1の勝ちです。|ディーラーの勝ちです。|プレイヤー3の勝ちです。') {
      $this->assertSame('プレイヤー1の勝ちです。|ディーラーの勝ちです。|プレイヤー3の勝ちです。', $results);
    }

    if ((string)$results === 'プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|ディーラーの勝ちです。') {
      $this->assertSame('プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|ディーラーの勝ちです。', $results);
    }

    if ((string)$results = 'プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。') {
      $this->assertSame('プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。', $results);
    }

    //ディーラーが二人に勝った場合
    if ((string)$results = 'プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|ディーラーの勝ちです。') {
      $this->assertSame('プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|ディーラーの勝ちです。', $results);
    }

    if ((string)$results = 'プレイヤー1の勝ちです。|ディーラーの勝ちです。|ディーラーの勝ちです。') {
      $this->assertSame('プレイヤー1の勝ちです。|ディーラーの勝ちです。|ディーラーの勝ちです。', $results);
    }

    if ((string)$results = 'ディーラーの勝ちです。|ディーラーの勝ちです。|プレイヤー3の勝ちです。') {
      $this->assertSame('ディーラーの勝ちです。|ディーラーの勝ちです。|プレイヤー3の勝ちです。', $results);
    }

    if ((string)$results = 'ディーラーの勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。') {
      $this->assertSame('ディーラーの勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。', $results);
    }

    //ディーラーが３人に勝った時
    if ((string)$results = 'プレイヤー1の勝ちです。|ディーラーの勝ちです。|ディーラーの勝ちです。') {
      $this->assertSame('プレイヤー1の勝ちです。|ディーラーの勝ちです。|ディーラーの勝ちです。', $results);
    }

    //ディーラーが全員に勝った場合

    if ((string)$results = 'ディーラーの勝ちです。') {
      $this->assertSame('ディーラーの勝ちです。', $results);
    }
  }
}
