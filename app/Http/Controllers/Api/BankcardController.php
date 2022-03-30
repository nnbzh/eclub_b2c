<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bankcard\StoreBankcardRequest;
use App\Services\Payment\Providers\Paybox\Facades\Paybox;

class BankcardController extends Controller
{
    public function store(StoreBankcardRequest $request) {
        Paybox::getUrlForCardAddition($request->user());
    }

}
