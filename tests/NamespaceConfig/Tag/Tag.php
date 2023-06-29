<?php

namespace berthott\Targetable\Tests\NamespaceConfig\Tag;

use berthott\Targetable\Tests\NamespaceConfig\CrudableTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use CrudableTrait;
}
