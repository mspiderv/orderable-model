<?php

namespace Vitlabs\OrderableModel;

interface OrderableModelContract
{

	public function getOrderColumnName();

	public function getOrderColumnDirection();

}