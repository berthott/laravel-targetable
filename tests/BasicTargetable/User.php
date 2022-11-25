<?php

namespace berthott\Targetable\Tests\BasicTargetable;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use CrudableTrait;
}
