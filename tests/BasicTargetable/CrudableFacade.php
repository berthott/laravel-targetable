<?php

namespace berthott\Targetable\Tests\BasicTargetable;

use Illuminate\Support\Facades\Facade;

class CrudableFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'CrudableFacade';
    }
}
