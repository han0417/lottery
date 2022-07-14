<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LotteryService;
use App\Http\Resources\LotteryResource;

class LotteryController extends Controller
{
    public function lottery():object
    {
        $result = LotteryService::getLottery();
        return new LotteryResource(['result' => $result]);
    }
}
