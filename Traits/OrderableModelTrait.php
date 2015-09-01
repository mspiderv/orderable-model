<?php

namespace Vitlabs\OrderableModel\Traits;

use \Illuminate\Database\Eloquent\Builder;
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

    /**
     * Finish processing on a successful save operation.
     * Then set correct order value.
     *
     * @param  array  $options
     * @return void
     */
    protected function finishSave(array $options)
    {
        $result = parent::finishSave($options);

        if ($this->wasRecentlyCreated)
        {
            $id = $this->getAttribute($this->getKeyName());
            $order = $this->getAttribute(self::getOrderColumnName());

            if ($id != $order)
            {
                $this->setAttribute(self::getOrderColumnName(), $id);
                $this->save();
            }
        }

        return $result;
    }

}