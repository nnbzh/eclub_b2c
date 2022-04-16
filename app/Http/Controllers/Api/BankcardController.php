<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bankcard\StoreBankcardRequest;
use App\Services\Payment\Providers\OneVision\Facades\OneVision;
use App\Services\Payment\Providers\Paybox\Facades\Paybox;
use Illuminate\Http\Request;

class BankcardController extends Controller
{
    public function store(StoreBankcardRequest $request) {
        $url = OneVision::getUrlForCardAddition($request->user());

        return response()->json(['data' => ['url' => $url]]);
    }

    public function payboxStoreCallback(Request $request) {

    }
}
