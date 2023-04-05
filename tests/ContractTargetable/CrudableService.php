<?php

namespace berthott\Targetable\Tests\ContractTargetable;

use berthott\Targetable\Enums\Mode;
use berthott\Targetable\Services\TargetableService;

class CrudableService extends TargetableService
{
    /**
     * The Constructor.
     */
    public function __construct()
    {
        parent::__construct(CrudableInterface::class, 'crudable', Mode::Contract);
    }
}
