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

    public function getOrderColumnName()
    {
        return (property_exists($this, 'orderColumnName')) ? $this->orderColumn : 'order';
    }

    public function getOrderColumnDirection()
    {
        return (property_exists($this, 'orderColumnDirection')) ? $this->orderColumnDirection : 'asc';
    }
}