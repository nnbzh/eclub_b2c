<?php

namespace App\Services\Order;

use App\Classes\CRMOrder;
use App\Helpers\OrderChannel;
use App\Models\Privilege;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\UserAddressRepository;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private UserAddressRepository $userAddressRepository
    )
    {
    }

    public function create(User $user, array $data) {
        if ($user->hasPrivilege(Privilege::FREE_DELIVERY)) {
            $hasFreeDelivery = true;
        } else {
            $hasFreeDelivery = false;
        }

        $data = $this->prepare($user, $data, $hasFreeDelivery);
        $order = $this->orderRepository->create($data);
        $order->products()->sync($data['products']);
        $crmOrder = new CRMOrder($order);
        $response = $crmOrder->sendToCrm();
        $this->orderRepository->update($order, ['number' => $response['number']]);

        return $order;
    }

    private function prepare($user, $data, $hasFreeDelivery) {
        $data['user_id']        = $user->id;
        $data['customer_name']  = $data['customer_name'] ?? $user->name;
        $data['customer_phone'] = $data['customer_phone'] ?? $user->phone;
        if (isset($data['user_address_id'])) {
            $userAddress = $this->userAddressRepository->getBy('id', $data['user_address_id']);
            $data['address'] = [
                'address'   => $userAddress->address ?? '',
                'city_id'   => $userAddress->city_id,
                'floor'     => $userAddress->floor ?? '',
                'entrance'  => $userAddress->entrance ?? '',
                'apartment' => $userAddress->apartment ?? '',
                'lat'       => $userAddress->lat ?? '',
                'lng'       => $userAddress->lng ?? '',
            ];
        }
        $newCost = $data['cost'] - ($data['delivery_cost'] ?? 0) + ($data['used_bonuses'] ?? 0);
        $data['fields_json']    = array_merge($data['fields_json'], ['delivery_free'    => (int) $hasFreeDelivery]);
        $data['fields_json']    = array_merge($data['fields_json'], ['new_cost'         => $newCost]);
        $data['fields_json']    = array_merge($data['fields_json'], ['channel'          => OrderChannel::CHANNELS[$data['fields_json']['channel']]]);

        return $data;
    }
}
