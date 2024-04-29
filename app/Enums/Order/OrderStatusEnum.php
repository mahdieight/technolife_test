<?php

namespace App\Enums\Order;

use App\Enums\Enum;

enum OrderStatusEnum: string
{
    use Enum;

    case DELIVERED   = 'delivered';
    case CANCELED = 'canceled';
    case DOING = 'doing';
}
