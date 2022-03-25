<?php

namespace App\Services\PaymentMethod;

use App\Repositories\PaymentMethodRepository;

class PaymentMethodService
{
    private $paymentMethodRepo;

    public function __construct(PaymentMethodRepository $paymentMethodRepo)
    {
        $this->paymentMethodRepo = $paymentMethodRepo;
    }

    public function list($cityId) {
        return $this->paymentMethodRepo->list($cityId);
    }
}
