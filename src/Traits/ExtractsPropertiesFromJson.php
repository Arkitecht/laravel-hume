<?php

namespace Arkitecht\LaravelHume\Traits;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Str;
use ReflectionProperty;

trait ExtractsPropertiesFromJson
{
    protected $_json;

    public static function fromJson(array $json): static
    {
        $object = new static();
        $object->_json = $json;
        $class = new \ReflectionClass(get_class($object));

        foreach ($json as $key => $value) {
            $key = str($key)->replace('/', '_')->camel();

            $property = new ReflectionProperty(get_class($object), $key);
            $propertyType = $property->getType();
            if (is_a($propertyType, \ReflectionUnionType::class)) {
                $propertyType = $propertyType->getTypes()[0];
            }
            $propertyType = $propertyType->getName();
            if ($value === null) {
                continue;
            }

            if (Str::contains($propertyType, 'Arkitecht\LaravelHume\Classes')) {
                $object->$key = $propertyType::fromJson($value);

                continue;
            }
            if (Str::contains($propertyType, 'Arkitecht\LaravelHume\Enums')) {
                $object->$key = $propertyType::from($value);

                continue;
            }
            $object->$key = $value;
        }

        if (method_exists($object, 'afterExtraction')) {
            $object->afterExtraction();
        }

        return $object;
    }

    public function toArray(): array
    {
        $class = new \ReflectionClass(get_class($this));
        $properties = $class->getProperties();

        $object = clone $this;
        unset($object->_json);
        unset($object->_excludes);

        if (isset($this->_excludes)) {
            foreach ($this->_excludes as $exclude) {
                unset($object->$exclude);
            }
        }

        $objectArray = [];
        foreach ($properties as $property) {
            $name = $property->getName();

            $objectProperty = new ReflectionProperty(get_class($this), $name);
            $propertyType = $objectProperty->getType()?->getName();
            $arrayName = Str::snake($name);

            if (!isset($object->{$name}) || (empty($object->{$name}) && !is_int($object->{$name}))) {
                continue;
            }

            if (Str::contains($propertyType, 'Arkitecht\LaravelHume\Classes')) {
                $value = $object->{$name}->toArray();

                if ($value) {
                    $objectArray[ $arrayName ] = $value;
                }

                continue;
            }
            if (Str::contains($propertyType, 'Arkitecht\LaravelHume\Enums')) {
                $objectArray[ $arrayName ] = $object->{$name}?->value;

                continue;
            }

            $objectArray[ $arrayName ] = $object->{$name} ?? null;
        }

        return $objectArray;
    }

}
