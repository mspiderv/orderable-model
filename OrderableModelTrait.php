<?php

namespace Vitlabs\OrderableModel;

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
}