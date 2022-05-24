<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reminder\StoreReminderRequest;
use App\Http\Requests\Reminder\SyncRemindersRequest;
use App\Http\Requests\Reminder\UpdateReminderRequest;
use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use App\Services\Reminder\ReminderService;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function __construct(private ReminderService $reminderService)
    {
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $reminders = $user->reminders()->get();

        return ReminderResource::collection($reminders);
    }

    public function store(StoreReminderRequest $request)
    {
        $user = $request->user();
        $reminder = $this->reminderService->createForUser($user, $request->validated());

        return new ReminderResource($reminder);
    }

    public function synchronize(SyncRemindersRequest $request)
    {
        $user = $request->user();
        $reminders = $this->reminderService->sync($user, $request->validated());

        return ReminderResource::collection($reminders);
    }

    public function update(Reminder $reminder, UpdateReminderRequest $request)
    {
        $reminder = $this->reminderService->update($reminder, $request->validated());

        return new ReminderResource($reminder);
    }

    public function destroy(Request $request, Reminder $reminder)
    {
        $reminder->delete();

        return response()->noContent(200);
    }
}
