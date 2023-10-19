<?php

// use PHPUnit\Framework\TestCase;

// require_once(__DIR__ . '/../lib/card3Poker.php');
// class card3PokerTest extends TestCase
// {
//   public function testReturnResult()
//   {

//     $this->assertSame(['high card', 'pair', 2], showDown('CK', 'DJ', 'H9', 'C10', 'H10', 'D3'));
//     $this->assertSame(['high card', 'straight', 2], showDown('CK', 'DA', 'H2', 'C3', 'H4', 'S5'));
//     $this->assertSame(['high card', 'three card', 2], showDown('CK', 'DJ', 'H9', 'C3', 'H3', 'S3'));
//     $this->assertSame(['straight', 'pair', 1],   showDown('C3', 'H4', 'S5', 'DK', 'SK', 'D10'));
//     $this->assertSame(['three card', 'pair', 1],  showDown('C3', 'H3', 'S3', 'DK', 'SK', 'D10'));
//     $this->assertSame(['three card', 'straight', 1], showDown('C3', 'H3', 'S3', 'DK', 'SJ', 'DQ'));
//     $this->assertSame(['high card', 'high card', 1], showDown('HJ', 'SK', 'D9', 'DQ', 'D10', 'H8'));
//     $this->assertSame(['high card', 'high card', 2], showDown('H9', 'SK', 'H7', 'DK', 'D10', 'H5'));
//     $this->assertSame(['high card', 'high card', 1], showDown('H9', 'SK', 'H7', 'DK', 'D9', 'H5'));
//     $this->assertSame(['high card', 'high card', 0], showDown('H3', 'S5', 'C7', 'D5', 'S7', 'D3'));
//     $this->assertSame(['pair', 'pair', 1], showDown('CA', 'DA', 'DK', 'C2', 'D2', 'C3'));
//     $this->assertSame(['pair', 'pair', 2], showDown('CK', 'DK', 'SA', 'CA', 'DA', 'SK'));
//     $this->assertSame(['pair', 'pair', 1], showDown('C4', 'D4', 'S7', 'H4', 'S4', 'C6'));
//     $this->assertSame(['pair', 'pair', 0], showDown('C4', 'D4', 'S7', 'H4', 'S4', 'C7'));
//     $this->assertSame(['straight', 'straight', 1], showDown('SA', 'DK', 'DQ', 'CA', 'C2', 'D3'));
//     $this->assertSame(['straight', 'straight', 1], showDown('SA', 'DK', 'DQ', 'CK', 'CQ', 'DJ'));
//     $this->assertSame(['straight', 'straight', 1], showDown('S2', 'H3', 'D4', 'CA', 'C2', 'D3'));
//     $this->assertSame(['straight', 'straight', 0], showDown('S2', 'S3', 'S4', 'C2', 'C3', 'D4'));
//     $this->assertSame(['three card', 'three card', 2], showDown('S2', 'C2', 'D2', 'CA', 'HA', 'SA'));
//     $this->assertSame(['three card', 'three card', 2], showDown('SK', 'CK', 'DK', 'CA', 'HA', 'SA'));
//     $this->assertSame(['three card', 'three card', 2], showDown('S2', 'C2', 'D2', 'C3', 'H3', 'S3'));




//     // $this->assertSame(['straight', 'high card', 1], showDown('C3', 'D2', 'C4', 'H10'));
//     // $this->assertSame(['high card', 'pair', 2], showDown('CK', 'DJ', 'C10', 'H10'));
//     // $this->assertSame(['high card', 'straight', 2], showDown('CK', 'DJ', 'C3', 'H4'));
//     // $this->assertSame(['straight', 'pair', 1], showDown('C3', 'H4', 'DK', 'SK'));
//     // $this->assertSame(['high card', 'high card', 1], showDown('HJ', 'SK', 'DQ', 'D10'));
//     // $this->assertSame(['high card', 'high card', 2], showDown('H9', 'SK', 'DK', 'D10'));
//     // $this->assertSame(['high card', 'high card', 0], showDown('H3', 'S5', 'D5', 'D3'));
//     // $this->assertSame(['pair', 'pair', 1], showDown('CA', 'DA', 'C2', 'D2'));
//     // $this->assertSame(['pair', 'pair', 2], showDown('CK', 'DK', 'CA', 'DA'));
//     // $this->assertSame(['pair', 'pair', 0], showDown('C4', 'D4', 'H4', 'S4'));
//     // $this->assertSame(['straight', 'straight', 1], showDown('SA', 'DK', 'C2', 'CA'));
//     // $this->assertSame(['straight', 'straight', 2], showDown('C2', 'CA', 'S2', 'D3'));
//     // $this->assertSame(['straight', 'straight', 0], showDown('S2', 'D3', 'C2', 'H3'));
//   }
// }
