<?php

namespace berthott\Targetable\Tests\NamespaceConfig\User;

use berthott\Targetable\Tests\NamespaceConfig\CrudableTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use CrudableTrait;
}
