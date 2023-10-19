<?php

namespace blackJack;

class DrawCard
{
    public array $drawCard;
    //カードをスートとナンバーで分離用の変数
    public string $cardStr;
    public string $suit;
    public string $cardNum;

    //デッキ生成用
    public array $cardDeck = [];
    public const CARD_NUM_LIST = [
        'A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K',
    ];
    public const SUIT_LIST = ['D', 'S', 'H', 'C'];

    public function deckCreate(): array
    {
        foreach (self::SUIT_LIST as $suit) {
            foreach (self::CARD_NUM_LIST as $cardNum) {
                $this->cardDeck[] = $suit . $cardNum;   //DA D10
            }
        }
        //デッキの配列要素をランダムに並び替える　※最初の１回のみ
        shuffle($this->cardDeck);
        return $this->cardDeck;
    }


    public function drawCard(): array
    {
        //draw処理のパーツ
        // //配列の先頭から1枚目までドロー
        $this->drawCard = array_slice($this->cardDeck, 0, 1);
        //デッキからドローしたカードを削除実行  デッキへ結果を返す
        $this->cardDeck = array_diff($this->cardDeck, $this->drawCard);
        //デッキのindexを詰める(デッキ減数と必ずセット)
        $this->cardDeck = array_values($this->cardDeck);

        //引いたカード(DA)とAを分離　例：[ダイヤ] の　[A]
        //カードのスート
        $this->suit = substr((string)$this->drawCard[0], 0, 1);

        //カードの数字
        $this->cardNum = substr((string)$this->drawCard[0], 1, strlen((string)$this->drawCard[0]) - 1);

        return [$this->suit, $this->cardNum];
    }
}
