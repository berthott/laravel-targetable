<?php

namespace berthott\Targetable\Enums;

/**
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
