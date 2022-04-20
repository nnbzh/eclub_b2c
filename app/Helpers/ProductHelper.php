<?php

namespace App\Helpers;

class ProductHelper
{
    const RECIPE_NO     = 0;
    const RECIPE_YES    = 1;
    const RECIPE_HARD   = 2;

    const UNIT_PIECE    = 10;
    const UNIT_KG       = 11;
    const UNIT_GR       = 12;

    public function getRecipeOptions() {
        return [
            self::RECIPE_NO     => trans('helpers.recipe_no'),
            self::RECIPE_YES    => trans('helpers.recipe_yes'),
            self::RECIPE_HARD   => trans('helpers.recipe_hard')
        ];
    }

    public function getUnitOptions() {
        return [
            self::UNIT_KG       => trans('helpers.unit_kg'),
            self::UNIT_GR       => trans('helpers.unit_gr'),
            self::UNIT_PIECE    => trans('helpers.unit_piece'),
        ];
    }
}
