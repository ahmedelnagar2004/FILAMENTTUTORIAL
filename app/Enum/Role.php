<?php

namespace App\Enum;

enum Role: string
{
    case ADMIN = 'admin';
    case SUBSCRIBER = 'subscriber';
    case EDITOR = 'editor';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::SUBSCRIBER => 'Subscriber',
            self::EDITOR => 'Editor',
        };
    }
}
