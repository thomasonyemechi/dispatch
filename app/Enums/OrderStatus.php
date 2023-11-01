<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case DISPATCHED = 'dispatched';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';

    public static function fromInt(int $status): self
    {
        return match ($status) {
            1 => self::PENDING,
            2 => self::COMPLETED,
            3 => self::DISPATCHED,
            4 => self::DELIVERED,
            5 => self::CANCELED,
            default => null, // Handle any other cases as needed
        };
    }

    public function statusClass(): string
    {
        return match ($this) {
            self::PENDING => 'text-warning',
            self::COMPLETED => 'text-success',
            self::DISPATCHED => 'text-info',
            self::DELIVERED => 'text-primary',
            self::CANCELED => 'text-danger',
            default => 'text-muted',
        };
    }

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

    public static function all(): array
    {
        return [
            self::PENDING,
            self::COMPLETED,
            self::DISPATCHED,
            self::DELIVERED,
            self::CANCELED,
        ];
    }
}
