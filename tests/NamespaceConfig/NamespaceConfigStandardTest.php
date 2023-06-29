<?php

namespace berthott\Targetable\Tests\NamespaceConfig;

use berthott\Targetable\Tests\NamespaceConfig\Tag\Tag;
use berthott\Targetable\Tests\NamespaceConfig\User\User;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase;

class NamespaceConfigStandardTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            CrudableServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        Config::set('crudable.namespace', __NAMESPACE__.'\User');
    }

    public function test_standard_option(): void
    {
        $this->assertContains(User::class, CrudableFacade::getTargetableClasses());
        $this->assertNotContains(Tag::class, CrudableFacade::getTargetableClasses());
    }
}
