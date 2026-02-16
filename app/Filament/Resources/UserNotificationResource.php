<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserNotificationResource\Pages;
use App\Models\UserNotification;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;

class UserNotificationResource extends Resource
{
    protected static ?string $model = UserNotification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationGroup = 'Users & Access';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationLabel = 'Notifications';

    protected static ?string $modelLabel = 'Notification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Compose Notification')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Recipient')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('All Users (Broadcast)')
                            ->helperText('Leave empty to broadcast to all users.'),
                        Forms\Components\Select::make('type')
                            ->options([
                                'info' => '🔵 Info',
                                'success' => '🟢 Success',
                                'warning' => '🟡 Warning',
                            ])
                            ->required()
                            ->default('info'),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Withdrawal Processed')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('message')
                            ->required()
                            ->columnSpanFull()
                            ->placeholder('Write your notification message here...'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Recipient')
                    ->placeholder('📢 All Users')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold')
                    ->limit(40),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'info' => 'info',
                        'success' => 'success',
                        'warning' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean()
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->trueColor('success')
                    ->falseColor('gray'),
                Tables\Columns\TextColumn::make('sender.name')
                    ->label('Sent By')
                    ->placeholder('System'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Sent At')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'info' => 'Info',
                        'success' => 'Success',
                        'warning' => 'Warning',
                    ]),
                SelectFilter::make('recipient')
                    ->label('Recipient Type')
                    ->options([
                        'broadcast' => 'Broadcast',
                        'individual' => 'Individual',
                    ])
                    ->query(function ($query, $data) {
                        return match ($data['value']) {
                            'broadcast' => $query->whereNull('user_id'),
                            'individual' => $query->whereNotNull('user_id'),
                            default => $query,
                        };
                    }),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserNotifications::route('/'),
            'create' => Pages\CreateUserNotification::route('/create'),
            'edit' => Pages\EditUserNotification::route('/{record}/edit'),
        ];
    }
}
