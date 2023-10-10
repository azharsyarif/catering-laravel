<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Anak;
use App\Models\Wali;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\AnakResource\Pages;
use App\Filament\Resources\CustomTableResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AnakResource\Pages\EditAnak;
use App\Filament\Resources\AnakResource\Pages\ListAnaks;
use App\Filament\Resources\AnakResource\Pages\CreateAnak;
use App\Filament\Resources\AnakResource\RelationManagers;



class AnakResource extends Resource
{
    protected static ?string $model = Anak::class;
    protected static ?string $navigationLabel = 'Anak';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_anak')->required(),
                        TextInput::make('kelas')->required(),
                        Select::make('wali_id')->label('nama wali')->options(Wali::all()->pluck('nama', 'id'))->searchable()
                    ])
                    ->columns(1),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('nama_anak')->sortable()->searchable(),
                TextColumn::make('kelas')->sortable()->searchable(),
                TextColumn::make('wali.nama')->label('Nama Wali')->searchable(),
            ])
            ->filters([
                Filter::make('Nama Wali')->label('Nama Anak')
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
            'index' => Pages\ListAnaks::route('/'),
            'create' => Pages\CreateAnak::route('/create'),
            'edit' => Pages\EditAnak::route('/{record}/edit'),
        ];
    }    
}

?>
