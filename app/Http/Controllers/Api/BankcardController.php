<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bankcard\StoreBankcardRequest;
use App\Services\Payment\Providers\OneVision\Facades\OneVision;

class BankcardController extends Controller
{
    public function getUrlForAddition(StoreBankcardRequest $request) {
        $url = OneVision::getUrlForCardAddition($request->user());

        return response()->json(['data' => ['url' => $url]]);
    }

    public function store() {

    }
}
