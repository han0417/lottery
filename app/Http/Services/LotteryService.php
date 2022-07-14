<?php

namespace App\Http\Services;

class LotteryService
{
    /**
     * 抽獎邏輯
     * @return string
     */
    public static function getLottery(): string
    {
        $pool = [];
        $firstPrizeOdds = (string)config('app.lottery.first_prize_percent');
        $secondPrizeOdds = (string)config('app.lottery.second_prize_percent');
        $decimalPlaces = 0;

        //確認小數位數
        if (strpos($firstPrizeOdds, '.')) {
            $strExplode = explode('.', $firstPrizeOdds);
            $decimalPlaces = strlen($strExplode[1]);
        }

        if (strpos($secondPrizeOdds, '.')) {
            $strExplode = explode('.', $secondPrizeOdds);
            if ($strExplode[1] > $decimalPlaces) {
                $decimalPlaces = strlen($strExplode[1]);
            }
        }

        //把樣本塞入陣列
        $firstPrizeSample = (int)$firstPrizeOdds * pow(10, $decimalPlaces);
        $secondPrizeSample = (int)$secondPrizeOdds * pow(10, $decimalPlaces);
        $noPrizeSample = (100 * pow(10, $decimalPlaces)) - $firstPrizeSample - $secondPrizeSample;

        for ($i = 0; $i < $firstPrizeSample; $i++) {
            array_push($pool, '一獎');
        }

        for ($i = 0; $i < $secondPrizeSample; $i++) {
            array_push($pool, '二獎');
        }

        for ($i = 0; $i < $noPrizeSample; $i++) {
            array_push($pool, '沒中獎');
        }
        shuffle($pool);

        return array_shift($pool);
    }
}
