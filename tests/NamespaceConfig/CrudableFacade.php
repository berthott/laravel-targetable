<?php

namespace berthott\Targetable\Tests\NamespaceConfig;

use Illuminate\Support\Facades\Facade;

class CrudableFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'CrudableFacade';
    }
}
