<?php

    namespace App\DTOs;

class CriteriaDTO {

    #[\App\Attributes\Length(min:3, max:10)]
    #[\App\Attributes\NotBlank]
    public ?string $name = null;

    #[\App\Attributes\NotBlank]
    public ?string $description = null;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
    }
}
