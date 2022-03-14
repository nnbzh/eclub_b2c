<?php

namespace App\Services\ApiServices;

use App\Repositories\Api\ElogistRepository;
use App\Repositories\Api\SlotRepository;
use Carbon\Carbon;

class SlotService
{
    public function __construct(
        private SlotRepository $slotRepository,
        private ElogistRepository $elogistRepository
    ) {}

    public function getSlotsForToday($cityId) {
        $slots = $this->slotRepository->getTodaySlotsByCityId($cityId);
        $delayedSlots = $this->elogistRepository->getDelayedSlotsByCityId($cityId, Carbon::now()->toDateString());

        return $this->mapSlots($slots, $delayedSlots);
    }

    public function getSlotsForTomorrow($cityId) {
        $slots = $this->slotRepository->getTomorrowSlotsByCityId($cityId);
        $delayedSlots = $this->elogistRepository->getDelayedSlotsByCityId($cityId, Carbon::now()->addDay()->toDateString());

        return $this->mapSlots($slots, $delayedSlots);
    }

    public function mapSlots($slots, $delayedSlots) {
        $delayedSlots = collect($delayedSlots['data'] ?? [])->keyBy('slot_id');

        foreach ($slots as &$slot) {
            $slot['is_late'] = ! empty($delayedSlots[$slot['id']]);
            $slot['message'] = $delayedSlots[$slot['id']]['status_label'] ?? null;
        }

        return $slots;
    }
}
