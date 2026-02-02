<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker ;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput; 
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
   

            ->components([

                //add taps 
                Tabs::make('post info')->tabs([
                    Tab::make('basic info')->schema([
                        Select::make('category_id')->label('Category')->relationship('Category','name')->required(),
                        TextInput::make('title')->required(),
                        TextInput::make('slug')->required(),
                        
                    ]),

                    Tab::make('content')->schema([
                        MarkdownEditor::make('content')
                        ->helperText('Content of the post')
                            ->label('Content')
                          //  ->helperText('Content of the post')
                            ->default(null)
                            ->columnSpanFull(),

                            TextInput::make('thumbnail')
                        ->default(null),
                    Toggle::make('published')
                            ->required(),
                    ]),

                    Tab::make('settings')->schema([
                        TagsInput::make('tags')
                    ->default(null)
                    ->columnSpanFull(),
                ColorPicker::make('color')
                    ->required(),
                    ])

                ]),
                
                
              
            ]);
    }
}
