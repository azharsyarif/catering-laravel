<?php

namespace App\Filament\Resources\WaliResource\Pages;

use App\Filament\Resources\WaliResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWali extends EditRecord
{
    protected static string $resource = WaliResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
