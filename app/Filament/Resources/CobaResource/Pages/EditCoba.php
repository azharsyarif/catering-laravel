<?php

namespace App\Filament\Resources\CobaResource\Pages;

use App\Filament\Resources\CobaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoba extends EditRecord
{
    protected static string $resource = CobaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
