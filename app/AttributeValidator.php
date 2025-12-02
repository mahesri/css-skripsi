<?php

namespace App;

use App\Attributes\Length;
use App\Attributes\NotBlank;
use Exception;
use ReflectionClass;
use ReflectionProperty;

trait AttributeValidator
{
    public function ValidateWithAttribute(Object $object): void
    {
        $class = new ReflectionClass($object);
        $properties = $class->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property){
            $this->ValidateNotBlank($property, $object);
            $this->ValidateLength($property, $object);
        }
    }

    private function ValidateNotBlank(ReflectionProperty $property, Object $object): void
    {

        $attributes = $property->getAttributes(NotBlank::class);

        if (count($attributes) > 0 ){

        if(!$property->isInitialized($object))
            throw new Exception("Property $property->name haven't initialized!");
        if ($property->getValue($object) == null)
            throw new Exception("Property $property->name is null!");
        }
    }

    private function ValidateLength(ReflectionProperty $property, Object $object)
    {

        if(!$property->isInitialized($object) || $property->getValue($object) == null) {
            return;
        }

        $value = $property->getValue($object);
        $attributes = $property->getAttributes(Length::class);

        foreach ($attributes as $attribute){

            $length = $attribute->newInstance();

            $strLength = strlen($value);
            $name = $property->getName();


        if ($strLength > $length->max)
            throw new Exception("Property {$name} is to long! ({$strLength}/{$length->max})");
        if ($strLength < $length->min)
            throw new Exception("Property {$name} is to Short! ({$strLength}/{$length->min})");
        }
    }
}

