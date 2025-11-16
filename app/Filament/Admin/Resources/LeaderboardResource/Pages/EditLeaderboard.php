<?php

namespace App\Filament\Admin\Resources\LeaderboardResource\Pages;

use App\Filament\Admin\Resources\LeaderboardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeaderboard extends EditRecord
{
    protected static string $resource = LeaderboardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
