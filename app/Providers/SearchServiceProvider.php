<?php

namespace App\Providers;

use Algolia\AlgoliaSearch\Config\SearchConfig;
use Algolia\AlgoliaSearch\SearchClient;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use Laravel\Scout\Engines\AlgoliaEngine;

class SearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        resolve(EngineManager::class)->extend('algolia', function () {
            $config = SearchConfig::create(
                config('scout.algolia.id'),
                config('scout.algolia.secret')
            )->setDefaultHeaders(
                $this->defaultHeaders()
            );

            return new AlgoliaEngine(
                SearchClient::createWithConfig($config),
                config('scout.soft_delete')
            );
        });
    }

    protected function defaultHeaders(): array
    {
        $ip = \Request::ip();
        $user = \Request::user();

        $headers['clickAnalytics'] = true;

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            $headers['X-Forwarded-For'] = $ip;
        }

        if ($user) {
            $headers['X-Algolia-UserToken'] = $user->id;
        }

        return $headers;
    }
}
