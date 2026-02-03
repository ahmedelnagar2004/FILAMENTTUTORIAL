<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Pages\ViewPost;
use App\Filament\Resources\Posts\RelationManagers\UsersRelationManager;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Schemas\PostInfolist;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use UnitEnum;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static string|UnitEnum|null $navigationGroup = 'Content management';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Blog';
    protected static ?string $recordTitleAttribute = ' Post';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PostInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'view' => ViewPost::route('/{record}'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Post::where('published', 1)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 2 ? 'danger' : 'success';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        if(static::getModel()::count() > 2) {
            return 'you must publish at least 2 posts';
        } else {
            return 'this is a blog post good';
        }
 
    }
  
}