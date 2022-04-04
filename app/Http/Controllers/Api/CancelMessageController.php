<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CancelMessageResource;
use App\Models\CancelMessage;
use Illuminate\Http\Request;

class CancelMessageController extends Controller
{
    public function index(Request $request) {
        $messages = CancelMessage::query()->select('id', 'message')->get();

        return CancelMessageResource::collection($messages);
    }
}
