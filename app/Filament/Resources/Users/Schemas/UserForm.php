<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Enum\Role;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('email')->label('Email address')->email()->required()->unique('users','email'),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')->password()->required(fn(string $context):bool=> $context === 'create')->visibleOn('create')->minLength(8),
                Select::make('role')->options(Role::class)->required(),
                
            ]);
    }
}
