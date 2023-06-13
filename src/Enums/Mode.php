<?php

namespace berthott\Targetable\Enums;

/**
 * The mode TargetableService is operating in.
 * 
 * * **Trait** checks if the given trait is used by the class
 * * **Contract** checks if the given contract is implemented by the class
 * 
 * @see \berthott\Targetable\Services\TargetableService::__construct()
 * @api
 */
enum Mode
{
    case Trait;
    case Contract;
}
