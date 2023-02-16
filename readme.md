# Laravel-Targetable

Laravel Helper for targeting classes by their traits.

## Installation

```
$ composer require berthott/laravel-targetable
```

## Usage

* Create your own Service inheriting `berthott\Targetable\Services\TargetableService`
* Pass the trait you want to target, and the config name you chose

```php
class TestService extends TargetableService
{
    /**
     * The Constructor.
     */
    public function __construct()
    {
        parent::__construct(YourTrait::class, 'your-config');
    }
}
```

* For further details on possibilities on how to utilize this service have a look inside `tests/BasicTargetable`

## Options

To change the default options add the following options to your config:
* `namespace`: string or array with one ore multiple namespaces that should be monitored for the Crudable-Trait. Defaults to `App\Models`.
* `namespace_mode`: Defines the search mode for the namespaces. `ClassFinder::STANDARD_MODE` will only find the exact matching namespace, `ClassFinder::RECURSIVE_MODE` will find all subnamespaces. Defaults to `ClassFinder::STANDARD_MODE`.
* `prefix`: route prefix. Defaults to `api`

Your config might look like this:
```php
<?php

use HaydenPierce\ClassFinder\ClassFinder;

return [

    /*
    |--------------------------------------------------------------------------
    | Model Namespace Configuration
    |--------------------------------------------------------------------------
    |
    | Defines one or multiple model namespaces.
    |
    */

    'namespace' => 'App\Models',

    /*
    |--------------------------------------------------------------------------
    | Model Namespace Search Option
    |--------------------------------------------------------------------------
    |
    | Defines the search mode for the namespaces. ClassFinder::STANDARD_MODE
    | will only find the exact matching namespace, ClassFinder::RECURSIVE_MODE
    | will find all subnamespaces. Beware: ClassFinder::RECURSIVE_MODE might 
    | cause some testing issues.
    |
    */

    'namespace_mode' => ClassFinder::STANDARD_MODE,

    /*
    |--------------------------------------------------------------------------
    | API Prefix
    |--------------------------------------------------------------------------
    |
    | Defines the api prefix.
    |
    */

    'prefix' => 'api',
];
```

## Compatibility

Tested with Laravel 10.x.

## License

See [License File](license.md). Copyright © 2023 Jan Bladt.