<?php

namespace App\Facades;

use App\Classes\TweetsHelper;
use Illuminate\Support\Facades\Facade;

class TweetsHelperFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TweetsHelper::class;
    }
}