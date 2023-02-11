<?php

declare(strict_types=1);

namespace Orders;

class OrderDeliveryDetails
{
	public static function getDeliveryDetails($productsCount): string
	{
        return "Order delivery time: {$productsCount} day" . ($productsCount>1?'s':'');
	}
}
