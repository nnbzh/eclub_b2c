<?php

namespace App\Helpers;

class SubscriptionSponsor
{
    const VISA  = 'visa_free';
    const DARYN = 'daryn_free';
    const SELF  = 'self';

    public static function getFreeSubscriptionSponsors() {
        return [self::VISA, self::DARYN];
    }
}
