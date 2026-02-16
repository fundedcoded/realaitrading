<?php

namespace App\Filament\Resources\UserNotificationResource\Pages;

use App\Filament\Resources\UserNotificationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateUserNotification extends CreateRecord
{
    protected static string $resource = UserNotificationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['sent_by'] = Auth::id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
