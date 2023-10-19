<?php

namespace blackJack;

require_once('DrawCard.php');
require_once('PlayersRun.php');
require_once('players.php');
require_once('Deler.php');
require_once('Player1.php');
require_once('Player2.php');
require_once('Player3.php');
require_once('ScoreConversionRun.php');
require_once('ScoreConversionSet.php');
require_once('ScoreConversion.php');
require_once('BlackJackWinnersRule.php');
require_once('BlackJackWinnersJudge.php');
require_once('BlackJackWinnersBeginnerRule.php');

class BlackJackGame
{
    private array $hands = [];
    private array $delerHands = [];
    private array $cpuPlayerHands = [];
    private string $decision;

    public function gameStart(): string
    {
        //デッキを生成
        $drawCard = new DrawCard();
        $drawCard->deckCreate();
        //インスタンス生成 プレイヤー1
        $player1 = new Player1($drawCard);
        $runsPlayer = new PlayersRun($player1);
        $player2 = new Player2($drawCard);
        $runsPlayer2 = new PlayersRun($player2);
        $player3 = new Player3($drawCard);
        $runsPlayer3 = new PlayersRun($player3);
        $deler = new Deler($drawCard);
        $runsDeler = new PlayersRun($deler);
        //NOTE:手札は各Player毎のクラスで保有
        //NOTE:ゲーム開始時に全プレイヤーは2ドローする
        $this->startDraw($deler, $runsDeler, $player1, $runsPlayer, $player2, $runsPlayer2, $player3, $runsPlayer3);
        $delerSecondHands = $deler->handList[1];

        //NOTE:あなたは21点を超えない限り、Y/Nで意思選択しドローすることができる
        $this->playersDraw($player1, $runsPlayer);
        //NOTE:CPUプレイヤーは21点を超えない限り自動でドローを続ける
        $this->cpuPlayerDraw($player2, $runsPlayer2, $player3, $runsPlayer3);
        echo 'ディーラーの引いた2枚目のカードは' . $delerSecondHands[0] . 'の' . $delerSecondHands[1] . 'でした。' . PHP_EOL;

        //NOTE:全プレイヤーが21点を超えていた時点で、ディーラーの全勝利が確定しゲーム終了
        if ($player1->point > 21 && $player2->point > 21 && $player3->point > 21) {
            echo '現時点でプレイヤー1,2,3,4の負けは確定しました' . PHP_EOL;

            //NOTE:プレイヤーいずれかが21点以下ならディーラーは17点を超えるまで引き続ける
        } elseif (21 >= $player1->point || 21 >= $player2->point || 21 >= $player3->point) {
            while (18 > $deler->point) {
                $this->delerDraw($deler, $runsDeler);
            }
        }

        //NOTE:ゲームResult
        echo 'あなたの得点は' . $player1->point . 'です。';
        echo 'プレイヤー2の得点は' . $player2->point . 'です。';
        echo 'プレイヤー3の得点は' . $player3->point . 'です。';
        echo 'ディーラーの得点は' . $deler->point . 'です。' . PHP_EOL;
        //NOTE:勝者
        $winner = $this->winnerResult($deler, $player1, $player2, $player3);
        echo $winner . PHP_EOL;
        echo 'ブラックジャックを終了します。' . PHP_EOL;
        return $winner;
    }


    private function playerDecision(): bool
    {
        //NOTE:入力値を受け取る  Y/N
        $this->decision = trim(fgets(STDIN));
        if ($this->decision === 'Y') {
            return true;
        } else {
            return false;
        }
    }

    private function startDraw($deler, $runsDeler, $player1, $runsPlayer, $player2, $runsPlayer2, $player3, $runsPlayer3): void
    {
        // foreach([]){

        // }
        //NOTE:ゲーム開始時、全プレイヤー２枚ドロー
        $this->hands = $runsPlayer->playerRun();
        $player1->playersPoint();
        echo 'あなた' . 'の引いたカードは' . $this->hands[0] . 'の' . $this->hands[1] . 'です' . PHP_EOL;
        $this->hands = $runsPlayer->playerRun();
        $player1->playersPoint();
        echo 'あなた' . 'の引いたカードは' . $this->hands[0] . 'の' . $this->hands[1] . 'です' . PHP_EOL;
        //NOTE:プレイヤー２
        $this->hands = $runsPlayer2->playerRun();
        $player2->playersPoint();
        echo 'プレイヤー2' . 'の引いたカードは' . $this->hands[0] . 'の' . $this->hands[1] . 'です' . PHP_EOL;
        $this->hands = $runsPlayer2->playerRun();
        $player2->playersPoint();
        echo 'プレイヤー2' . 'の引いたカードは' . $this->hands[0] . 'の' . $this->hands[1] . 'です' . PHP_EOL;
        //NOTE:プレイヤー3
        $this->hands = $runsPlayer3->playerRun();
        $player3->playersPoint();
        echo 'プレイヤー3' . 'の引いたカードは' . $this->hands[0] . 'の' . $this->hands[1] . 'です' . PHP_EOL;
        $this->hands = $runsPlayer3->playerRun();
        $player3->playersPoint();
        echo 'プレイヤー3' . 'の引いたカードは' . $this->hands[0] . 'の' . $this->hands[1] . 'です' . PHP_EOL;
        //NOTE ディーラー
        $this->delerHands = $runsDeler->playerRun();
        $deler->playersPoint();
        echo 'ディーラー' . 'の引いたカードは' . $this->delerHands[0] . 'の' . $this->delerHands[1] . 'です' . PHP_EOL;
        $this->delerHands = $runsDeler->playerRun();
        $deler->playersPoint();
        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
    }


    private function playersDraw($player1, $runsPlayer): void
    {
        //NOTE:プレイヤーはカードの合計値が21を超えるまで引き続けることが可能
        while (21 > $player1->point) {
            echo 'あなたの現在の得点は' . $player1->point . 'です。' . 'カードを引きますか？（Y/N）' . PHP_EOL;
            //NOTE:Yドロー、Nドローしない
            if ($this->playerDecision()) {
                $this->hands = $runsPlayer->playerRun();
                $player1->playersPoint();
                echo 'あなたの引いたカードは' . $this->hands[0] . 'の' . $this->hands[1] . 'です。' . PHP_EOL;
            } else {
                break;
            }
        }
    }

    private function delerDraw($deler, $runsDeler): void
    {
        //NOTE:ディーラーは17点を超えるまで引き続ける
        $this->delerHands = $runsDeler->playerRun();
        $deler->playersPoint();
        echo 'ディーラーの引いたカードは' . $this->delerHands[0] . 'の' . $this->delerHands[1] . 'でした。' . PHP_EOL;
        echo 'ディーラーの現在の得点は' . $deler->point . 'です。' . PHP_EOL;
    }


    private function cpuPlayerDraw($player2, $runsPlayer2, $player3, $runsPlayer3): void
    {
        //NOTE:CPUは21点以下なら自動ドローを続ける
        //NOTE:CPU2
        while (21 > (int)$player2->point) {
            if (21 > (int)$player2->point) {
                $this->cpuPlayerHands = $runsPlayer2->playerRun();
                $player2->playersPoint();
                echo 'プレイヤー2の引いたカードは' . $this->cpuPlayerHands[0] . 'の' . $this->cpuPlayerHands[1] . 'です。' . PHP_EOL;
                echo 'プレイヤー2の現在の得点は' . $player2->point . 'です。' . PHP_EOL;
            }
        }
        //NOTE:CPU3
        while (21 > $player3->point) {
            if (21 > $player3->point) {
                $this->cpuPlayerHands = $runsPlayer3->playerRun();
                $player3->playersPoint();
                echo 'プレイヤー3の引いたカードは' . $this->cpuPlayerHands[0] . 'の' . $this->cpuPlayerHands[1] . 'です。' . PHP_EOL;
                echo 'プレイヤー3の現在の得点は' . $player3->point . 'です。' . PHP_EOL;
            }
        }
    }

    private function winnerResult($deler, $player1, $player2, $player3): string
    {
        // 勝敗結果処理
        $winnersRule = new BlackJackWinnersBeginnerRule();
        $winnersJudge = new BlackJackWinnersJudge($winnersRule);
        $winner = $winnersJudge->winnersJudgeRun([$deler->point, $player1->point, $player2->point, $player3->point]);
        return $winner;
    }
}
