<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Menu;
use Filament\Tables;
use App\Models\Order;
use App\Models\OrderDetail;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderDetailResource\Pages;
use App\Filament\Resources\OrderDetailResource\RelationManagers;
use Filament\Panel;
use Filament\Support\Colors\Color;

class OrderDetailResource extends Resource
{
    protected static ?string $model = OrderDetail::class;
    protected static ?string $navigationLabel = 'Order Detail';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Order';
    

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('order_id')->options(Order::all()->pluck('wali.nama', 'id')),
                        Select::make('menu_id')->options(Menu::all()->pluck('nama_menu','id'))->nullable(),
                        // Select::make('status')->label('Status')
                        //     ->options([
                        //     'baru' => 'Baru',
                        //     'dalam proses' => 'Dalam Proses',
                        //     'seleasi' => 'Selesai'
                        // ])
                        // ->default('baru'),
                        TextInput::make('total'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id'),
                TextColumn::make('menu.nama_menu'),
                TextColumn::make('order.tanggal_pemesanan'),
                TextColumn::make('status'),
                TextColumn::make('total'),
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
            'index' => Pages\ListOrderDetails::route('/'),
            'create' => Pages\CreateOrderDetail::route('/create'),
            'edit' => Pages\EditOrderDetail::route('/{record}/edit'),
        ];
    }    
}
