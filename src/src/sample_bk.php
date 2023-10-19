<?php

//○インプット例
//1 30 5 25 2 30 1 15
//○アウトプット例
//1.7
//1 45 2
//2 30 1
//5 25 1


// $i = 0;

// $ch1 = 0;
// $ch1Min = 0;
// $ch2 = 0;
// $ch2Min = 0;
// $ch3 = 0;
// $ch3Min = 0;
// $ch4 = 0;
// $ch4Min = 0;
// $ch5 = 0;
// $ch5Min = 0;
// $ch6 = 0;
// $ch6Min = 0;
// $ch7 = 0;
// $ch7Min = 0;
// $ch8 = 0;
// $ch8Min = 0;
// $ch9 = 0;
// $ch9Min = 0;
// $ch10 = 0;
// $ch10Min = 0;
// $ch11 = 0;
// $ch11Min = 0;
// $ch12 = 0;
// $ch12Min = 0;
// $intConversion = [];
// $totalMin = 0;

// //入力と空白区切りで配列に分割
// $watchData = fgets(STDIN);
// $watchData = explode(' ', $watchData);

// //int型に変換
// foreach ($watchData as $wData) {
// $intConversion[] = (int)$wData;
// }

// foreach ($intConversion as $wData) {
// //偶数はチャンネル
// if ($i % 2 === 0) {
// if ($wData === 1) {
// //チャンネル1 視聴数
// $ch1 = $ch1 + 1;
// //チャンネル1 分数
// $i += 1;
// $ch1Min = $ch1Min + $intConversion[$i];
// } elseif ($wData === 2) {
// //チャンネル2 視聴数
// $ch2 = $ch2 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch2Min = $ch2Min + $intConversion[$i];
// } elseif ($wData === 3) {
// //チャンネル2 視聴数
// $ch3 = $ch3 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch3Min = $ch3Min + $intConversion[$i];
// } elseif ($wData === 4) {
// //チャンネル2 視聴数
// $ch4 = $ch4 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch4Min = $ch4Min + $intConversion[$i];
// } elseif ($wData === 5) {
// //チャンネル2 視聴数
// $ch5 = $ch5 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch5Min = $ch5Min + $intConversion[$i];
// } elseif ($wData === 6) {
// //チャンネル2 視聴数
// $ch6 = $ch6 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch6Min = $ch6Min + $intConversion[$i];
// } elseif ($wData === 7) {
// //チャンネル2 視聴数
// $ch7 = $ch7 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch7Min = $ch7Min + $intConversion[$i];
// } elseif ($wData === 8) {
// //チャンネル2 視聴数
// $ch8 = $ch8 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch8Min = $ch8Min + $intConversion[$i];
// } elseif ($wData === 9) {
// //チャンネル2 視聴数
// $ch9 = $ch9 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch9Min = $ch9Min + $intConversion[$i];
// } elseif ($wData === 10) {
// //チャンネル2 視聴数
// $ch10 = $ch10 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch10Min = $ch10Min + $intConversion[$i];
// } elseif ($wData === 11) {
// //チャンネル2 視聴数
// $ch11 = $ch11 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch11Min = $ch11Min + $intConversion[$i];
// } elseif ($wData === 12) {
// //チャンネル2 視聴数
// $ch12 = $ch12 + 1;
// //チャンネル1 分数
// $i = $i + 1;
// $ch12Min = $ch12Min + $intConversion[$i];
// }
// //奇数は分数
// } else {
// //分数の合計
// $totalMin = $totalMin + $wData;
// $i += 1;
// }
// }


// //テレビの合計視聴時間
// $totalMin = $totalMin / 60;
// echo round($totalMin, 1) . PHP_EOL;
// // var_dump($totalMin);

// ////チャンネル 視聴分数 視聴回数
// if ($ch1Min > 0) {
// echo '1' . ' ' . $ch1Min . ' ' . $ch1 . PHP_EOL;
// }
// if ($ch2Min > 0) {
// echo '2' . ' ' . $ch2Min . ' ' . $ch2 . PHP_EOL;
// }
// if ($ch3Min > 0) {
// echo '3' . ' ' . $ch3Min . ' ' . $ch3 . PHP_EOL;
// }
// if ($ch4Min > 0) {
// echo '4' . ' ' . $ch4Min . ' ' . $ch4 . PHP_EOL;
// }
// if ($ch5Min > 0) {
// echo '5' . ' ' . $ch5Min . ' ' . $ch5 . PHP_EOL;
// }
// if ($ch6Min > 0) {
// echo '6' . ' ' . $ch6Min . ' ' . $ch6 . PHP_EOL;
// }
// if ($ch7Min > 0) {
// echo '7' . ' ' . $ch7Min . ' ' . $ch7 . PHP_EOL;
// }
// if ($ch8Min > 0) {
// echo '8' . ' ' . $ch8Min . ' ' . $ch8 . PHP_EOL;
// }
// if ($ch9Min > 0) {
// echo '9' . ' ' . $ch9Min . ' ' . $ch9 . PHP_EOL;
// }
// if ($ch10Min > 0) {
// echo '10' . ' ' . $ch10Min . ' ' . $ch10 . PHP_EOL;
// }
// if ($ch11Min > 0) {
// echo '11' . ' ' . $ch11Min . ' ' . $ch11 . PHP_EOL;
// }
// if ($ch12Min > 0) {
// echo '12' . ' ' . $ch12Min . ' ' . $ch12 . PHP_EOL;
// }
