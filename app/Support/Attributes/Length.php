<?php

namespace App\Support\Attributes;

namespace App\Attributes;
use Attribute;

#[Attribute(\Attribute::TARGET_PROPERTY)]
class Length
{

    public function __construct(
        public int $max,
        public int $min
    ){}
}
