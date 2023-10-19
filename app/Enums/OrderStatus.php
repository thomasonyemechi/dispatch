<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case DISPATCHED = 'dispatched';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';

    public function statusCode(): int
    {
        return match ($this) {
            self::PENDING => 1,
            self::COMPLETED => 2,
            self::DISPATCHED => 3,
            self::DELIVERED => 4,
            self::CANCELED => 5,
        };
    }
}
