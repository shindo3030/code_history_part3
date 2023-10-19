<?php

namespace blackJack;

require_once('BlackJackWinnersRule.php');
require_once('BlackJackWinnersJudge.php');
class BlackJackWinnersBeginnerRule implements BlackJackWinnersRule
{
    //NOTE:各プレイヤーの総合ポイント
    public int $delerPoint = 0;
    public int $player1Point = 0;
    public int $player2Point = 0;
    public int $player3Point = 0;
    //NOTE:絶対値(21 - 総合ポイント)
    public int $player1PointAbs = 0;
    public int $player2PointAbs = 0;
    public int $player3PointAbs = 0;
    //NOTE:勝者判定
    public array $winnerJudge = [];
    public array $loserArr = [];
    //NOTE:勝者
    public string $winner;

    public function winner(array $pointArr): string
    {
        $delerPoint = (int)$pointArr[0];
        $player1Point = (int)$pointArr[1];
        $player2Point = (int)$pointArr[2];
        $player3Point = (int)$pointArr[3];

        $player1PointInt = 21 - (int)$pointArr[1];
        $player2PointInt = 21 - (int)$pointArr[2];
        $player3PointInt = 21 - (int)$pointArr[3];

        $delerPoinAbs = abs(21 - $delerPoint);
        $player1PointAbs = abs(21 - $player1Point);
        $player2PointAbs = abs(21 - $player2Point);
        $player3PointAbs = abs(21 - $player3Point);
        $winner = 'プレイヤー1の勝ちです。';

        if ((int)$player1Point > 21 && (int)$player2Point > 21 && (int)$player3Point > 21) {
            $winner = 'ディーラーの勝ちです。';
            return $winner;
        }

        //TODO:ナチュラルブラックジャックの追加
        // if (
        //     count($player1->handList) === 2 & $player1Point === 21 & 21
        //     > $delerPoint
        // ) {
        //     $this->winnerJudge[] = 'プレイヤー1の勝ちです。';
        // } elseif (count($deler->handList) === 2 & $delerPoint === 21& 21
        //     > $player1Point) {
        //     $this->winnerJudge[] = 'ディーラーの勝ちです。';
        // } elseif (
        //     count($deler->handList) === 2 & count($player1->handList) === 2& $delerPoint === 21 & 21
        //     === $player1Point &
        // ) {
        //     $this->winnerJudge[] = '引き分けです。';
        // }



        //NOTE:プレイヤー1とディーラーの引き分け
        if ($player1Point === $delerPoint && $player1PointInt > -1) {
            $this->winnerJudge[] = '引き分けです。';
            //NOTE:プレイヤーが21を超えていた時点でディーラー勝利,二人とも21オーバーの場合ドロー順でプレイヤーの負け
        } elseif ($player1Point > 21) {
            $this->winnerJudge[] = 'ディーラーの勝ちです。';
            //NOTE:ディーラーが21オーバーの時点でプレイヤーの勝利　
        } elseif ($delerPoint > 21) {
            $this->winnerJudge[] = 'プレイヤー1の勝ちです。';
            //NOTE:プレイヤーディーラーが21以下の範囲なら勝敗判定を行う
        } elseif (21 >= $delerPoint && 21 >= $player1Point) {
            //NOTE:絶対値が最も0(21)に近いプレイヤー
            $min = min($player1PointAbs, $delerPoinAbs);
            if ($min === $player1PointAbs) {
                $this->winnerJudge[] = 'プレイヤー1の勝ちです。';
            }
            //NOTE:絶対値が最も0(21)に近いディーラー
            if ($min === $delerPoinAbs) {
                $this->winnerJudge[] = 'ディーラーの勝ちです。';
            }
        }


        #TODO:ナチュラルブラックジャックの追加

        //NOTE:プレイヤー２とディーラーの引き分け
        if ($player2Point === $delerPoint && $player2PointInt > -1) {
            $this->winnerJudge[] = '引き分けです。';
            //NOTE:21を超えていた時点でディーラーが勝利
        } elseif ($player2Point > 21) {
            $this->winnerJudge[] = 'ディーラーの勝ちです。';
            //NOTE:ディーラーが21を超えていたらプレイヤー2の勝利
        } elseif ($delerPoint > 21) {
            $this->winnerJudge[] = 'プレイヤー2の勝ちです。';
            //NOTE:プレイヤーディーラーが21以下の範囲なら勝敗判定を行う
        } elseif (21 >= $delerPoint && 21 >= $player2Point) {
            $min = min($player2PointAbs, $delerPoinAbs);
            //NOTE:最も0(21)に近いプレイヤー
            if ($min === $player2PointAbs) {
                //NOTE:プレイヤー2の勝ち
                $this->winnerJudge[] = 'プレイヤー2の勝ちです。';
            }
            //NOTE:0に近い(21)人はディーラー
            if ($min === $delerPoinAbs) {
                //NOTE:最も0(21)に近い人
                $this->winnerJudge[] = 'ディーラーの勝ちです。';
            }
        }


        #TODO:ナチュラルブラックジャックの追加はここ

        //NOTE:プレイヤー3とディーラーの引き分け
        if (
            $player3Point === $delerPoint && $player3PointInt > -1
        ) {
            $this->winnerJudge[] = '引き分けです。';
            //NOTE:21を超えていた時点でディーラーが勝利
        } elseif ($player3Point > 21) {
            $this->winnerJudge[] = 'ディーラーの勝ちです。';
            //NOTE:ディーラーが21を超えていたらプレイヤー2の勝利
        } elseif ($delerPoint > 21) {
            $this->winnerJudge[] = 'プレイヤー3の勝ちです。';
            //NOTE:プレイヤーディーラーが21以下の範囲なら勝敗判定を行う
        } elseif (
            21 >= $delerPoint && 21 >= $player3Point
        ) {
            $min = min($player3PointAbs, $delerPoinAbs);
            //NOTE:最も0(21)に近い人
            if ($min === $player3PointAbs) {
                //NOTE:プレイヤー2の勝ち
                $this->winnerJudge[] = 'プレイヤー3の勝ちです。';
            }
            //NOTE:0に近い(21)人はディーラー
            if ($min === $delerPoinAbs) {
                //NOTE:最も0(21)に近い人
                $this->winnerJudge[] = 'ディーラーの勝ちです。';
            }
        }
        //NOTE:勝者配列を,区切りで文字列に変換
        $winner = implode("|", $this->winnerJudge);
        return $winner;
    }
}
