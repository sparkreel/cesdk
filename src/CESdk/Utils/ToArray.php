<?php
/**
 * User: Tabaré Caorsi <tabare@heapstersoft.com>
 * Date: 8/14/14
 * Time: 2:11 PM
 */

namespace CESdk\Utils;

use ReflectionClass;

trait ToArray
{
    public function toArray()
    {
        $array = array();
        $reflect = new ReflectionClass($this);

        $props = $reflect->getProperties();

        foreach ($props as $prop) {
            $methodName = sprintf('get%s', ucfirst($prop->getName()));
            if ($reflect->hasMethod($methodName)) {
                $value = $this->{$prop->getName()};
                if (is_object($value)) {
                    $reflectValue = new ReflectionClass($value);

                    if ($reflectValue->hasMethod('toArray')) {
                        $value = call_user_func(array($value, 'toArray'));
                    }

                }

                $array[$prop->getName()] = $value;
            }
        }

        return $array;
    }
} 