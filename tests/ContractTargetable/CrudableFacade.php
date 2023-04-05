<?php

namespace berthott\Targetable\Tests\ContractTargetable;

use Illuminate\Support\Facades\Facade;

class CrudableFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'CrudableFacade';
    }
}
