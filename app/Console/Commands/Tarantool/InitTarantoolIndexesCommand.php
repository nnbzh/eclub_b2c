<?php

namespace App\Console\Commands\Tarantool;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InitTarantoolIndexesCommand extends Command
{
    protected $signature = 'tarantool:init';

    protected $description = 'Initialize tarantool indexes';

    public function handle() {
        $this->initPricesTable();
        $this->initStocksTable();
        $this->initPharmacyStockTable();
    }

    public function initPricesTable() {
        DB::connection('tarantool')->statement(
            'CREATE TABLE "PRICES" (
                "ID" INTEGER PRIMARY KEY AUTOINCREMENT,
                "CITY_ID" INTEGER NOT NULL,
                "SKU" INTEGER NOT NULL,
                "PRICE" INTEGER NOT NULL,
                "MARKET_NUMBER" INTEGER NOT NULL,
                "SUB_PRICE" INTEGER NOT NULL,
                "CHANGED_AT" INTEGER NOT NULL
            );'
        );
    }

    public function initStocksTable()
    {
        DB::connection('tarantool')->statement(
            'CREATE TABLE "STOCKS" (
                "ID" INTEGER PRIMARY KEY AUTOINCREMENT,
                "CITY_ID" INTEGER NOT NULL,
                "SKU" INTEGER NOT NULL,
                "QUANTITY" INTEGER NOT NULL,
                "CHANGED_AT" INTEGER NOT NULL
            );'
        );
    }

    public function initPharmacyStockTable()
    {
        DB::connection('tarantool')->statement(
            'CREATE TABLE PHARMACY_STOCKS (
                "ID" INTEGER PRIMARY KEY AUTOINCREMENT,
                "PHARMACY_ID" INTEGER NOT NULL,
                "SKU" INTEGER NOT NULL,
                "QUANTITY" INTEGER NOT NULL,
                "CHANGED_AT" INTEGER NOT NULL
            );'
        );
    }
}
