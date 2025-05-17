<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PROCESSING = 'processing';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';

    public function label()
    {
        return match($this) {
            self::PROCESSING => 'В процессе',
            self::DELIVERED => 'Доставлен',
            self::CANCELLED => 'Отменен',
        };
    }
}