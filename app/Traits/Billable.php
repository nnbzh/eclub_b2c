<?php

namespace App\Traits;

use App\Helpers\TransactionStatus;
use App\Models\Transaction;

trait Billable
{
    public function getId() {
        return $this->id;
    }

    public function transactions() {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function transaction() {
        return $this->morphOne(Transaction::class, 'transactionable');
    }

    public function isPaid() {
        return $this->transactions()->where('status', TransactionStatus::SUCCEED)->exists();
    }

    public function isPending() {
        return $this->transactions()->where('status', TransactionStatus::PENDING)->exists();
    }
}
