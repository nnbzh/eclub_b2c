<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait IssuesToken
{
    public function issueToken(Request $request, $grant = 'phone', $scope = '') {
        $params = [
            'grant_type'    => $grant,
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'scope'         => $scope
        ];

        if ($grant === 'password') {
            $request->request->add(['username' => $request->get('phone')]);
        }

        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST', $request->request->all());
        $pipeline = app()->handle($proxy);

        if (! $pipeline->isSuccessful()) {
            $pipeline->throwResponse();
        }

        return $pipeline;
    }
}
