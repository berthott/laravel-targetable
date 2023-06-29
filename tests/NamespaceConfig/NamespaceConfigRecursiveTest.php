<?php

namespace berthott\Targetable\Tests\NamespaceConfig;

use berthott\Targetable\Tests\NamespaceConfig\Tag\Tag;
use berthott\Targetable\Tests\NamespaceConfig\User\User;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase;

class NamespaceConfigRecursiveTest extends TestCase
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
        Config::set('crudable.namespace', __NAMESPACE__);
        Config::set('crudable.namespace_mode', ClassFinder::RECURSIVE_MODE);
    }

    public function test_recursive_option(): void
    {
        $this->assertContains(User::class, CrudableFacade::getTargetableClasses());
        $this->assertContains(Tag::class, CrudableFacade::getTargetableClasses());
    }
}
