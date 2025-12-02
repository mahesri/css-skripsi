<?php

namespace App\Attributes;

use Attribute;

#[Attribute(\Attribute::TARGET_PROPERTY)]
class Length
{

    public function __construct(
        public int $min,
        public int $max
    ){}
}
