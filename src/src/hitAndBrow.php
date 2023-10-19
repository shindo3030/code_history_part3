<?php

function judge($correct, $answer)
{
    $hit = 0;
    $brow = 0;
    $answerArray = str_split((string)$answer);
    foreach ($answerArray as $index => $letter) {
        if (hitJudge($correct, $index, $letter)) {
            $hit++;
        }
        //hitの条件以外の時にbrow
        if (browJudge($correct, $index, $letter)) {
            $brow++;
        }
    }
    return [$hit, $brow];
}

function hitJudge($correct, $index, $letter)
{
    return (str_split((string)$correct)[$index] === $letter);
}

function browJudge($correct, $index, $letter)
{
    if (hitJudge($correct, $index, $letter)) {
        return false;
    }
    return in_array($letter, str_split((string)$correct), true);
}

// function judge($correct, $answer)
// {
//     $hitCount = 0;
//     $browCount = 0;
//     $answerArray = str_split((string)$answer);

//     foreach ($answerArray as $index => $letter) {
//         if (hitCondition($correct, $index, $letter)) {
//             $hitCount++;
//         }
//         if (browCondition($correct, $index, $letter)) {
//             $browCount++;
//         }
//     }
//     return [$hitCount, $browCount];
// }

// function hitCondition(string $correct, int $index, string $letter): bool
// {
//     return str_split($correct)[$index] === $letter;
// }

// function browCondition(string $correct, int $index, string $letter): bool
// {
//     if (hitCondition($correct, $index, $letter)) {
//         return false;
//     }
//     return in_array($letter, str_split((string)$correct), true);
// }







//judge(5678, 5678) [4,0]
//judge(5678, 7612) [1,1] ⇦
//judge(5678, 8756) [0,4]
//judge(5678, 1234) [0,0]

/*
    $inputs = [
        1 => [5,7],
        2 => [6,6],
        3 => [7,1],
        4 => [8,2],
    ];
*/

// function judge($correct, $answer)
// {
//     $inputs = [];
//     for ($i = 0; $i < 4; $i++) {
//         $inputs[$i][0] = substr($correct, $i, 1);
//         $inputs[$i][1] = substr($answer, $i, 1);
//     }
//     $hitAndBrowCounts = judgementHitAndBrow($inputs);
//     return $hitAndBrowCounts;
// }

// function judgementHitAndBrow(array $inputs): array
// {
//     //hit 桁数も完全一致
//     $HitCount = 0;
//     $browCount = 0;

//     foreach ($inputs as $input) {
//         $correctNum = $input[0];
//         $answerNum = $input[1];

//         if ($correctNum === $answerNum) {
//             $HitCount += 1;
//         } else {
//             for ($i = 0; $i < 4; $i++) {
//                 $browSarch = $inputs[$i][1];
//                 if ($correctNum === $browSarch) {
//                     $browCount += 1;
//                 }
//             }
//         }
//     }
//     $HitAndBrowCounts = [$HitCount, $browCount];
//     return $HitAndBrowCounts;
// }
