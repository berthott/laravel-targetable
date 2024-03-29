<?php

namespace berthott\Targetable\Tests\ContractTargetable;

class TargetableContractTest extends TestCase
{
    public function test_getTargetableClasses(): void
    {
        $this->assertContains(User::class, CrudableFacade::getTargetableClasses());
    }

    public function test_getTarget(): void
    {
        $this->get('api/users')->assertContent(User::class);
    }
}
