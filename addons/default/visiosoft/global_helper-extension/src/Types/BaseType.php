<?php
declare(strict_types=1);

namespace Visiosoft\GlobalHelperExtension\Types;

use ReflectionClass;
use Visiosoft\GlobalHelperExtension\Interfaces\BaseTypeInterface;

abstract class BaseType implements BaseTypeInterface
{

    public function setIfNotEmpty($setter, $value)
    {
        if (!empty($value)) {
            $setter = "set" . ucfirst(strtolower($setter));
            $this->$setter($value);
        }
    }

    public function toArray(): array
    {
        $result = [];

        $reflectionClass = new ReflectionClass($this);
        $properties = $reflectionClass->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $propertyValue = $property->getValue($this);

            if (!empty($propertyValue)) {
                if (is_array($propertyValue) && count($propertyValue) > 0 && is_object($propertyValue[0])) {
                    foreach ($propertyValue as $entry) {
                        $result[] = $entry->toArray();
                    }
                } else {
                    $result[$propertyName] = $propertyValue;
                }
            }
        }

        return $result;
    }

}