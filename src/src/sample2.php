<!-- <?php

      /*


パン屋さんの売上集計作業のプログラム
商品は１０種類あります。それぞれの金額は以下となります。
一日の売上の合計（税込）、販売個数の最も多い商品番号、販売個数の最も少ない商品を求める
1:100  2:120  3:150  4:250  5:80  6:120  7:100  8:180  9:50  10:300

入力形式は以下↓
販売した商品番号 販売個数 販売した商品番号 販売個数 ...

※販売した商品番号は1~10の整数で入力

アウトプットは以下↓
売上の合計
販売個数の最も多い商品番号
販売個数の最も少ない商品番号

※税率は10%とする。
販売個数の最も多い、少ない個数が同じ商品について、
販売個数が同数の商品が存在する場合、それら全ての商品番号を記載すること


*インプット例*
docker-compose exec app php sample2.php 1 10 2 3 5 1 7 5 10 1
*アウトプット例*
2464
1
5 10

▼データ構造
・要素名に商品番号、要素に値段が格納された配列を作成（グローバル変数or定数）
priceDataLists = [
    1 => 100,
    2 => 120,
    3 => 150,
    4 => 250,
    5 => 80,
    6 => 120,
    7 => 100,
    8 => 180,
    9 => 50,
    10 => 300,
];
・インプットで受け取ったデータについては
要素名に商品番号、要素に値段が格納された配列に置き換える
1 10 2 3 5 1 7 5 10 1
input = [
    1 => 10,
    2 => 3,
    5 => 1,
    7 => 5,
    10 => 1,
];
＊合計の値段の出力
インプットデータのkey名と商品リストの配列は商品番号の要素名が一致しているので
foreachでそれぞれのインプットデータ＊対象の商品リストの要素を指定して結果を$totalPriceへ代入し順に加算していく

＊最小最大値の出力
配列の最大値はmax(value)、最小値はmin(value)で導き出せる
最大最小で重複した場合は、（割り出した最小値、最大値を変数に入れ
インプットされたデータの配列をforeachを行い、もし取得した最小、最大値と等しい要素のみkeyを全て出力する）
*/

      const PANS_PRICE_LISTS = [
        1 => 100,
        2 => 120,
        3 => 150,
        4 => 250,
        5 => 80,
        6 => 120,
        7 => 100,
        8 => 180,
        9 => 50,
        10 => 300,
      ];
      //税率は10% = 1.10 (  (100% + 10%)/100  )
      const TAX = 10;   //1.10 を直接計算してしまうと丸め誤差が生じるため　小数を使わないように上手く1.10へ持っていく

      //インプットデータを使い易い形に整理（ 1000 360 80 500 300　）
      function inputs(): array
      {
        $inputs = array_slice($_SERVER['argv'], 1);
        $inputs = array_chunk($inputs, 2);

        return $inputs;
      }

      //インプットデータを使ってデータ構造を作成
      function salesData(array $inputs): array
      {
        $salesData = [];
        foreach ($inputs as $input) {
          $goodsNumCode = $input[0];
          $numOfSales = $input[1];
          $arrNumOfSales = [$numOfSales];

          if (array_key_exists($goodsNumCode, $salesData)) {
            $salesData[$goodsNumCode] = array_merge($salesData[$goodsNumCode], $arrNumOfSales);
          } else {
            $salesData[$goodsNumCode] = $arrNumOfSales;
          }
        }
        return $salesData;
      }

      //売上が最も高い商品番号と最も低い商品番号を重複しているもの込みで抽出
      function salesRank(array $salesData): array
      {
        $maxData = max($salesData);
        $minData = min($salesData);
        $maxDataLists = [];
        $minDataLists = [];

        foreach ($salesData as $goodsNumCode => $numOfSales) {
          $NumCode = $goodsNumCode;
          $arrNumCode = [$NumCode];

          if ($maxData === $numOfSales) {
            $maxDataLists = array_merge($maxDataLists, $arrNumCode);
          } elseif ($minData === $numOfSales) {
            $minDataLists = array_merge($minDataLists, $arrNumCode);
          }
        }
        return array($maxDataLists, $minDataLists);
      }


      //売上の合計を算出（画面表示とわんセット）
      function totalData(array $salesData): int
      {
        $totalPrice = [];
        $totalData = 0;

        foreach ($salesData as $saleNum => $saleData) {
          $listPrice = PANS_PRICE_LISTS[$saleNum];
          $buysPrice = $saleData[0];
          (int)$listPrice = $listPrice;
          (int)$buysPrice = $buysPrice;

          //$buysPriceがキャストしてもarray型となってしまい計算時に型エラーが出てしまう ⇨ $saleData[0]で解決！
          $total = $buysPrice * $listPrice * (100 + TAX) / 100;
          $totalData = $totalData + $total;
        }
        return $totalData;
      }

      //画面表示
      function display(array $salesData)
      {
        $totalData = totalData($salesData);
        echo $totalData . PHP_EOL;

        list($maxDataLists, $minDataLists) = salesRank($salesData);
        if (count($maxDataLists) > 0) {
          foreach ($maxDataLists as $maxData) {
            echo $maxData . ' ';
          }
          echo PHP_EOL;
        }
        if (count($minDataLists) > 0) {
          foreach ($minDataLists as $minData) {
            echo $minData . ' ';
          }
          echo PHP_EOL;
        }
      }


      $inputs = inputs();
      $salesData = salesData($inputs);
      totalData($salesData);
      display($salesData);





// echo count($maxDataLists) . PHP_EOL;
// echo count($minDataLists) . PHP_EOL;
// var_dump($maxDataLists);
// var_dump($minDataLists);





















// $userAges = [
//   'Tanaka' => 20,
//   'Kimura' => 25,
//   'Tabata' => 40,
// ];

// $AgesOver30 = array_filter($userAges, function ($v) {
//   return $v >= 30;
// });
// print_r($AgesOver30);


// $students = [1 => ['Tanaka', 'Sato', 'hati'], 2 => ['Kawasaki']];
// echo count($students) . PHP_EOL;

// //2





//docker-compose exec app php sample2.php 1 30 5 25 2 30 1 15
//○アウトプット例　結果
//1.7
//1 45 2
//2 30 1
//5 25 1

/*データ構造を決める
①
[
  [0] => [1],[30],
  [1] => [5],[25],
  [2] => [2],[30],
  [3] => [1],[15],
]
②完成系↓(どういうふうに配列を操作したら完成イメージに辿り着くかを考えるとやりやすいy！)
  channnel[
          要素名にch [1] => [30,15],
          要素名にch [5] => [25],
          要素名にch [2] => [30],
          ]

    ・chごとの配列の中身をarray_sumして合計
    ・チャンネルごとの名は要素名から引っ張って表示
    ・chごとの要素数で登場回数
    ・前チャンネルの中身を一つにまとめて合計すれば全部の合計
*/


// function inputs()
// {
//   $inputs = array_slice($_SERVER['argv'], 1);
//   return $inputs = array_chunk($inputs, 2);
// }

// function chDataLists($inputs)
// {
//   $chDataLists = [];
//   foreach ($inputs as $input) {
//     $chan = $input[0];  //チャンネル
//     $min = $input[1];  //視聴分数  chanが重複した場合、代入だと上書きされてしまうのでarray_merge用に配列にしておく
//     $minsArr = [$min];

//     if (array_key_exists($chan, $chDataLists)) {
//       $chDataLists[$chan] = array_merge($chDataLists[$chan], $minsArr);
//     } else {
//       $chDataLists[$chan] = $minsArr;
//     }
//   }
//   return $chDataLists;
// }

// function totalMins($chDataLists)
// {
//   //array_sumで合計の分数の計算を行うため配列を用意(array_mergeで連結)
//   $totalMins = [];
//   foreach ($chDataLists as $mins) {
//     $totalMins = array_merge($totalMins, $mins);
//   }
//   $totalSumData = array_sum($totalMins);
//   return $totalSumData = round($totalSumData / 60, 1);  //少数第一位までで四捨五入
// }

// function display($chDataLists)
// {
//   $totalSumData = totalMins($chDataLists);
//   echo $totalSumData . PHP_EOL;
//   ksort($chDataLists);  //キー名で昇順に並び替え
//   foreach ($chDataLists as $chan => $min) {
//     echo  $chan . ' ' . array_sum($min) . ' ' . count($min) . PHP_EOL;
//   }
// }

// $inputs = inputs();
// $chDataLists = chDataLists($inputs);
// display($chDataLists);














// function inputs()
// {
//   $inputs = array_slice($_SERVER['argv'], 1);
//   $inputs = array_chunk($inputs, 2);
//   return $inputs;
// }

// function chDataList($inputs)
// {
//   $chDataList = [];

//   foreach ($inputs as $input) {
//     $chan = $input[0];
//     $min = $input[1];
//     $mins = [$min];
//     if (array_key_exists($chan, $chDataList)) {
//       $chDataList[$chan] = array_merge($chDataList[$chan], $mins);
//     } else {
//       $chDataList[$chan] = $mins;
//     }
//   }

//   return $chDataList;
// }

// function total($chDataList)
// {
//   $total = [];
//   foreach ($chDataList as $chMin) {
//     $total = array_merge($total, $chMin);
//   }
//   $totalData = array_sum($total);
//   $totalData = round($totalData / 60, 1);
//   return $totalData;
// }

// function display($chDataList)
// {
//   // $test = [];
//   $totalData = total($chDataList);
//   echo $totalData . PHP_EOL;
//   foreach ($chDataList as $chan => $min) {
//     //$minは配列として展開されるので注意
//     echo $chan . ' ' . array_sum($min) . ' ' . count($min) . PHP_EOL;

//     //   if ($chan === 1 or $chan === 2) {
//     //     $test = array_merge($test, $min);
//     //   }
//   }
//   // $testData = array_sum($test);
//   // echo $testData . PHP_EOL;
// }

// $inputs = inputs();
// $chDataList = chDataList($inputs);
// display($chDataList);























// function inputs()
// {
//   $inputs = array_slice($_SERVER['argv'], 1);
//   $inputs = array_chunk($inputs, 2);
//   return $inputs;
// }

// function chData($inputs)
// {
//   $chData = [];
//   foreach ($inputs as list($ch, $m)) {
//     $chan = $ch;
//     $min = $m;
//     $mins = array($min);
//     if (array_key_exists($chan, $chData)) {
//       $chData[$chan] = array_merge($chData[$chan], $mins);
//     } else {
//       $chData[$chan] = $mins;
//     }
//   }
//   return $chData;
// }

// function totalData($chData)
// {
//   $total = [];
//   foreach ($chData as $minData) {
//     $total = array_merge($total, $minData);
//   }
//   $total = array_sum($total);
//   $totalData = round($total / 60, 1);
//   return $totalData;
// }

// function display($chData)
// {
//   $totalData = totalData($chData);
//   echo $totalData . PHP_EOL;
//   foreach ($chData as $ch => $min) {
//     echo $ch . ' ', array_sum($min) . ' ' . count($min) . PHP_EOL;
//   }
// }


// $inputs = inputs();
// $chData = chData($inputs);
// display($chData);

















// function inputs()
// {
//   $inputs = array_slice($_SERVER['argv'], 1);
//   $inputs = array_chunk($inputs, 2);
//   return $inputs;
// }

// function chDataLists($inputs)
// {
//   $chDataLists = [];
//   foreach ($inputs as $input) {
//     $chan = $input[0];
//     $min = $input[1];
//     $mins = array($min);

//     if (array_key_exists($chan, $chDataLists)) {
//       $chDataLists[$chan] = array_merge($chDataLists[$chan], $mins);
//     } else {
//       $chDataLists[$chan] = $mins;
//     }
//   }
//   return $chDataLists;
// }

// function total($chDataLists)
// {
//   $total = [];
//   foreach ($chDataLists as $min) {
//     $total = array_merge($total, $min);
//   }
//   $totalMin = array_sum($total);
//   $totalMin = round($totalMin / 60, 1);
//   return $totalMin;
// }

// function display($chDataLists)
// {
//   $totalM = total($chDataLists);
//   echo $totalM . PHP_EOL;
//   foreach ($chDataLists as $chan => $min) {
//     echo $chan . ' ' . array_sum($min) . ' ' . count($min) . PHP_EOL;
//   }
// }

// $inputs = inputs();
// $chDataLists = chDataLists($inputs);
// display($chDataLists);








// const CHUNK_NO = 2;

// function inputs()
// {
//   $inputs = array_slice($_SERVER['argv'], 1);
//   $inputs = array_chunk($inputs, CHUNK_NO);
//   return $inputs;
// }

// function chDataList($inputs)
// {
//   $chDataList = [];
//   foreach ($inputs as list($ch, $mi)) {
//     $chan = $ch;
//     $min = $mi;
//     $mins = [$min];

//     if (array_key_exists($chan, $chDataList)) {
//       $chDataList[$chan] = array_merge($chDataList[$chan], $mins);
//     } else {
//       $chDataList[$chan] = $mins;
//     }
//   }
//   return $chDataList;
// }

// function total($chDataList)
// {
//   $total = [];
//   foreach ($chDataList as $minData) {
//     $total = array_merge($total, $minData);
//   }
//   $totalMin = array_sum($total);
//   $totalMin = round($totalMin / 60, 1);
//   return $totalMin;
// }

// function display($chDataList)
// {
//   $totalData = total($chDataList);
//   echo $totalData . PHP_EOL;
//   foreach ($chDataList as $chan => $min) {
//     echo $chan . ' ' . array_sum($min) . ' ' . count($min) . PHP_EOL;
//   }
// }

// $inputs = inputs();
// $chDataList = chDataList($inputs);
// display($chDataList);







// function inputs(): array
// {
//   $inputs = array_slice($_SERVER['argv'], 1);
//   $inputs = array_chunk($inputs, 2);
//   return $inputs;
// }

// function chData($inputs)
// {
//   $chData = [];
//   foreach ($inputs as $input) {
//     $chan = $input[0]; //ch
//     $min = $input[1]; //min
//     $mins = [$min];

//     if (array_key_exists($chan, $chData)) {
//       $chData[$chan] = array_merge($chData[$chan], $mins);
//     } else {
//       $chData[$chan] =  $mins;
//     }
//   }
//   return $chData;
// }

// function totalData($chData)
// {
//   $arr1 = [];
//   foreach ($chData as $md) {
//     $arr1 = array_merge($arr1, $md);
//   }
//   $tm = array_sum($arr1);
//   $tm = round($tm / 60, 1);

//   return $tm;
// }

// function display($chData)
// {
//   $totalData = totalData($chData);
//   echo $totalData . PHP_EOL;
//   foreach ($chData as $chan => $min) {
//     echo $chan . ' ' . array_sum($min) . ' ' . count($min) . PHP_EOL;
//   }
// }


// $inputs = inputs();
// $chData = chData($inputs);
// display($chData);












// function inputData(): array
// {
//   $inputs = array_slice($_SERVER['argv'], 1);
//   return $inputs = array_chunk($inputs, 2);
// }

// function chDataList(array $inputs): array
// {
//   $total = [];
//   $chDatalist = [];
//   foreach ($inputs as list($c, $m)) {
//     $chan = $c;
//     $min = $m;
//     $mins = (array)$min;  //  [15]   [30]

//     if (array_key_exists($chan, $chDatalist)) {
//       $chDatalist[$chan] = array_merge($chDatalist[$chan], $mins);
//     } else {
//       $chDatalist[$chan] = $mins;
//     }
//   }
//   /*    [1] => '30'     */
//   return $chDatalist;
// }


// function total($chDataLists)
// {
//   $tm = [];
//   $total = 0;
//   foreach ($chDataLists as $m) {
//     // $total = $total + $m; //これはエラーになる理由は調べてみよう
//     $tm = array_merge($tm, $m);
//   }
//   $total = array_sum($tm);
//   return $total;
// }

// function display(array $chDataLists)
// {
//   $total = 0;
//   $total = total($chDataLists);
//   $total = round($total / 60, 1);
//   echo $total . PHP_EOL;
//   foreach ($chDataLists as $ch => $min) {
//     echo $ch . ' ' . array_sum($min)  . ' ' . count($min) . PHP_EOL;
//   }
// }


// //①
// $inputs = inputData();
// //②
// $chDataLists = chDataList($inputs);

// display($chDataLists);

















// echo '⚫︎ 対象の配列';
// $array5 = [
//   [[30, 120, 200, 50], ['20', '75', '100', '150']],
//   [[100, 20, 15, 500], ['5', '155', '650', '335']],
//   [[102, 22, 12, 50], ['45', '25', '70', '550'], [345, 21, '76', '523']]
// ];
// var_dump($array5);

// echo '⚫︎ array_sum()使用後-1' . PHP_EOL;
// $array5_sum1 = array_sum($array5[2][1]);
// echo '$array5[2][1]は：' . $array5_sum1 . PHP_EOL;
// echo $array5[2][1];



// //キー名用の変数
// $jpn = 'japan';

// //配列の作成
// $capital = array(); //初期化
// $capital["$jpn"] = '東京';
// echo $capital["$jpn"]; //東京






// //２点間の距離の計算　（平方根）
// $x1 = 1;
// $y1 = 1;
// $x2 = 2;
// $y2 = 2;

// echo sqrt(($x2 - $x1) ** 2 + ($y2 - $y1) ** 2);

// // echo ++$number . PHP_EOL;
// // echo $number . PHP_EOL;





// $ages = [
// 'Nakata' => 34,
// 'Abe' => 25,
// 'Kato' => 32,
// 'Watanabe' => 29,
// 'Fukuzawa' => 42,
// ];

// //キー名で昇順に並び替え
// ksort($ages);
// var_dump($ages);
// //値を降順に並び替え
// arsort($ages);
// var_dump($ages);

// $movie = [
// 'name' => 'totoro',
// ];
// $movie['year'] = 1988;
// var_dump($movie);
// $movie2 = [
// 'director' => 'MIYAZAKI HAYAO',
// ];
// $movie3 = array_merge($movie, $movie2);
// var_dump($movie3);

// var_dump(count($movie3));

// $weights = [
// 'aaa' => 50,
// 'bbb' => 100,
// 'ccc' => 70,
// ];
// asort($weights);
// var_dump($weights);


// $members = [
// 'taguchi',
// 'age' => '25',
// 'sales',
// ];
// var_dump($members);



// $members = [
// [
// 'name' => 'yamaura',
// 'team' => [
// 'sales',
// 'marketing',
// ]
// ]
// ];

// var_dump($members[0]['team'][1]); //marketing




// $number = 1;
// switch ($number) {
// case true:
// echo 'true' . PHP_EOL;
// break;

// case 1:
// echo '1' . PHP_EOL;
// break;

// default:
// echo 'default' . PHP_EOL;
// break;
// }


// $a = null;
// unset($a); //変数の割り当て削除
// var_dump($a);



// $arr1 = ['a', 'b'];
// $arr2 = [
// 0 => 'a',
// 1 => 'b',
// ];
// var_dump($arr1 === $arr2); //true　配列と連想配列は区別されていない！



// if (['0']) { //true
// echo 'true' . PHP_EOL;
// } else {
// echo 'false' . PHP_EOL;
// }



// //半角全角の変換
// var_dump(mb_convert_kana('1', 'Kas') === mb_convert_kana('１', 'Kas'));

// $str1 = 'abcde';
// $str2 = 'あいうえお';
// echo strlen($str1) . PHP_EOL;
// echo strlen($str2) . PHP_EOL;
// echo mb_strlen($str2) . PHP_EOL;



// $var = 1;
// //シングルクオートは変数を展開しない
// echo 'var years old';
// //ダブルクオートは変数を展開できる！
// echo "$var years old";
// //ダブルクオートは変数を展開できる！
// echo "${var} years old";
// //シングルクオートで変数を展開する場合はドットマークで変数と文字列を繋ぐ必要がある！
// echo $var . 'years old'; //繋げると年の前に空白がなくなるので注意




// var_dump(1.1);
// //指数表記　1.1の10の2乗 [100.1]　
// var_dump(1.1e2);
// var_dump(0.1 + 0.2); //float(0.30000000000000004)
// var_dump(0.1 + 0.2 === 0.3); //bool(false) 00004⇦が入ってるせいでfalse

// //bcMath関数は引数で少数を渡し文字列として返してくる、最後の引数1は少数点第１位まで表示させる設定
// $num = bcadd('0.1', '0.2', 1);
// var_dump((float)$num === 0.3);





// echo gettype(1) . PHP_EOL; //integer
// echo gettype(0) . PHP_EOL;
// echo gettype(-1) . PHP_EOL;

// var_dump(0b10); //２進数
// var_dump(010); //８進数
// var_dump(0x10); //１６進数

// var_dump(PHP_INT_MAX); //PHP整数型の最大値
// var_dump(PHP_INT_MAX + 1); //
// var_dump((PHP_INT_MAX + 1) === (PHP_INT_MAX + 2)); //

// const MAXIMUM_NAME_LENGTH = 10;
// //バリデーションのコードを修正
// echo '名前を入力してください' . PHP_EOL;
// $name = trim(fgets(STDIN));

// if (mb_strlen($name) < MAXIMUM_NAME_LENGTH) { // echo '名前の長さはOK!' . PHP_EOL; // } else { // echo '名前が長すぎます' . PHP_EOL; // } // //定数を使用して税率を計算 // const TAX=0.1; // $price=100 * (1 + TAX); // echo $price . PHP_EOL; // //定義し直しもできないよ！ // const TAX=0.12; // $price=100 * (1 + TAX); // echo $price . PHP_EOL; //欲しい実行結果は、12345678910 // $count=0; // function test($count) // { // $count++; // echo $count; // if ($count < 10) { // test($count); // } // } // test($count); //リファレンスについて // $c='php' ; // $d=&$c; // $c[0]='z' ; // echo $c . PHP_EOL; // echo $d . PHP_EOL; -->
