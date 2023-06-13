<?php

namespace berthott\Targetable\Enums;

/**
 * Mode for passing a class to {@see [TargetableService::__constructor]}.
 * 
 * * **Trait** checks if the given trait is used by the class
 * * **Contract** checks if the given contract is implemented by the class
 * 
 * @api
 */
enum Mode
{
    case Trait;
    case Contract;
}
