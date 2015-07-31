<?php

namespace Vitlabs\OrderableModel\Contracts;

interface OrderableModelContract
{

    public function getOrderColumnName();

    public function getOrderColumnDirection();

}