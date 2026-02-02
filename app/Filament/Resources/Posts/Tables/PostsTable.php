<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use App\Models\Category;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#ID')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable()->sortable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('thumbnail')
                    ->searchable(),
                IconColumn::make('published')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ColorColumn::make('color')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->searchDebounce('750ms')
            ->filters([
                Filter::make('published')->query(function (Builder $query) {
                    $query->where('published', 1);
                }),
                Filter::make('unpublished')->query(function (Builder $query) {
                    $query->where('published', 0);
                }),
                //select filter
                SelectFilter::make('Category_id')
                ->options(function () {
                    return Category::all()->pluck('name', 'id');
                })
                ->relationship('category','name')
                ->label('Category')
                ->searchable()
                ->preload()
                ->multiple()
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
