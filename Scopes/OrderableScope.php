<?php

namespace Vitlabs\OrderableModel\Scopes;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderableScope implements ScopeInterface
{
    /**
    * Apply the scope to a given Eloquent query builder.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $builder
    * @return void
    */
    public function apply(Builder $builder, Model $model)
    {
        $builder->getQuery()->orderBy($model::getOrderColumnName(), $model::getOrderColumnDirection());
    }

    /**
    * Remove the scope from the given Eloquent query builder.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $builder
    * @return void
    */
    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();
        $property = $query->unions ? 'unionOrders' : 'orders';
        $orderColumn = $model::getOrderColumnName();
        $orderDirection = $model::getOrderColumnDirection();

        foreach ($query->{$property} as $key => $order)
        {
            if ($order['column'] == $orderColumn && $order['direction'] == $orderDirection)
            {
                unset($query->{$property}[$key]);
            }
        }

        if (is_array($query->{$property}) && count($query->{$property}) == 0)
        {
            $query->{$property} = null;
        }
    }
}