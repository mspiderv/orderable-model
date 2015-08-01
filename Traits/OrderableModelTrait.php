<?php

namespace Vitlabs\OrderableModel\Traits;
use Vitlabs\OrderableModel\Scopes\OrderableScope;

trait OrderableModelTrait
{
    /**
    * Boot the orderable model trait for a model.
    *
    * @return void
    */
    public static function bootOrderableModelTrait()
    {
        static::addGlobalScope(new OrderableScope);
    }

    public static function getOrderColumnName()
    {
        return (property_exists(__CLASS__, 'orderColumnName')) ? static::$orderColumn : 'order';
    }

    public static function getOrderColumnDirection()
    {
        return (property_exists(__CLASS__, 'orderColumnDirection')) ? static::$orderColumnDirection : 'asc';
    }
}