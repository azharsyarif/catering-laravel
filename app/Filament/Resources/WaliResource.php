<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Wali;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\WaliResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WaliResource\Pages\EditWali;
use App\Filament\Resources\WaliResource\Pages\ListWalis;
use App\Filament\Resources\WaliResource\Pages\CreateWali;
use App\Filament\Resources\WaliResource\RelationManagers;

class WaliResource extends Resource
{
    protected static ?string $model = Wali::class;
    protected static ?string $navigationLabel = 'Wali Santri';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('email'),
                        TextInput::make('password')->password()->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                        TextInput::make('noTelepon'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('password')->limit('10'),
                TextColumn::make('noTelepon')->label('Nomor Telepon'),
                TextColumn::make('anak.nama_anak')->label('Anak Wali'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListWalis::route('/'),
            'create' => Pages\CreateWali::route('/create'),
            'edit' => Pages\EditWali::route('/{record}/edit'),
        ];
    }    
}
