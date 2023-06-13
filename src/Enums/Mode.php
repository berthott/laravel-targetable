<?php

namespace berthott\Targetable\Enums;

/**
 * Mode for passing a class to 
 * 
 * Here? {@see berthott\Targetable\Services\TargetableService::__constructor() hallo}.
 * A Link {@link https://syspons.com test link}
 * 
 * * **Trait** checks if the given trait is used by the class
 * * **Contract** checks if the given contract is implemented by the class
 * 
 * @api
 * @link https://syspons.com
 * @see [TargetableService::__constructor()]
 */
enum Mode
{
    case Trait;
    case Contract;
}
