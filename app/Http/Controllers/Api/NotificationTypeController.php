<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationTypeResource;
use App\Services\NotificationType\NotificationTypeService;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{
    public function __construct(private NotificationTypeService $notificationTypeService)
    {
    }

    public function index(Request $request) {
        $user   = $request->user();
        $types  = $this->notificationTypeService->list($user);

        return NotificationTypeResource::collection($types);
    }
}
