<?php

namespace berthott\Targetable\Tests\NamespaceConfig;

use berthott\Targetable\Services\TargetableService;

class CrudableService extends TargetableService
{
    /**
     * The Constructor.
     */
    public function __construct()
    {
        parent::__construct(CrudableTrait::class, 'crudable');
    }
}
