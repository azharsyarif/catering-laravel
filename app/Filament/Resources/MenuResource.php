<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Menu;
use Filament\Tables;
use PhpOption\Option;
use App\Models\Category;
use App\Models\Categories;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Illuminate\Validation\Rules\Enum;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\MenuResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Filament\Resources\MenuResource\Pages\EditMenu;
use App\Filament\Resources\MenuResource\Pages\ListMenus;
use App\Filament\Resources\MenuResource\Pages\CreateMenu;
use App\Filament\Resources\MenuResource\RelationManagers;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationLabel = 'Menu';

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_menu')->required(),
                        TextInput::make('deskripsi')->required(),
                        TextInput::make('gambar')->required(),
                        // FileUpload::make('gambar')->image(),
                        TextInput::make('harga'),
                        DatePicker::make('tanggal'),
                        Select::make('category_id')->options(Category::all()->pluck('name', 'id'))
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_menu')->sortable()->searchable(),
                ImageColumn::make('gambar'),
                TextColumn::make('deskripsi'),
                TextColumn::make('harga'),
                TextColumn::make('tanggal')->date(),
                TextColumn::make('category.name')->label('Category'),
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }    
}
