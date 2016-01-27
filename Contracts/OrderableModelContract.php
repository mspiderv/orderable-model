<?php

namespace Vitlabs\OrderableModel\Contracts;

interface OrderableModelContract
{
    public static function getOrderColumnName();

    public static function getOrderColumnDirection();
}