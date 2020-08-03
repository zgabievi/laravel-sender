<?php

namespace Zorb\Sender;

use Illuminate\Support\Facades\Facade;

class SenderFacade extends Facade
{
    //
    protected static function getFacadeAccessor()
    {
        return Sender::class;
    }
}
