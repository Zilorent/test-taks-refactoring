<?php

declare(strict_types=1);

namespace Orders;

class OrderDeliveryDetails
{
	public static function getDeliveryDetails($productsCount)
	{
		if ($productsCount > 1) {
			return 'Order delivery time: 2 days';
		} else {
			return 'Order delivery time: 1 day';
		}
	}
}
