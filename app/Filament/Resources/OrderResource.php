<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Wali;
use Filament\Tables;
use App\Models\Order;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Anak;
use App\Models\Menu;

use function Laravel\Prompts\select;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationLabel = 'Order';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Order';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('wali_id')->options(Wali::all()->pluck('nama', 'id')),
                        Select::make('menu_id')->options(Menu::all()->pluck('nama_menu', 'id')),
                        DatePicker::make('tanggal_pemesanan'),
                        // Select::make('status')->label('Status')
                        //     ->options([
                        //     'baru' => 'Baru',
                        //     'on_progress' => 'On Progress',
                        //     'selesai' => 'Selesai',
                        // ])
                        // ->default('baru'),
                        Select::make('anak_id')->options(Anak::all()->pluck('nama_anak', 'id')),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('wali.nama'),
                TextColumn::make('menu.nama_menu'),
                TextColumn::make('tanggal_pemesanan')->label('Tanggal'),
                // TextColumn::make('status'),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }    
}
