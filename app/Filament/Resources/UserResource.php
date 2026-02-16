<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Users & Access';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Account Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Facades\Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255),
                        Forms\Components\Select::make('role')
                            ->options([
                                'user' => 'User',
                                'admin' => 'Admin',
                            ])
                            ->required()
                            ->default('user'),
                    ])->columns(2),

                Forms\Components\Section::make('Status & Activity')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Account Active')
                            ->helperText('Disable to suspend this user — they will be logged out on their next request.')
                            ->default(true),
                        Forms\Components\Placeholder::make('last_login_at_display')
                            ->label('Last Login')
                            ->content(fn (?User $record): string => $record?->last_login_at?->diffForHumans() ?? 'Never'),
                        Forms\Components\Placeholder::make('last_login_ip_display')
                            ->label('Last Login IP')
                            ->content(fn (?User $record): string => $record?->last_login_ip ?? 'N/A'),
                        Forms\Components\Placeholder::make('created_at_display')
                            ->label('Registered')
                            ->content(fn (?User $record): string => $record?->created_at?->format('M d, Y h:i A') ?? '-'),
                    ])->columns(2)
                    ->visibleOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'user' => 'info',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->getStateUsing(fn (User $record): bool => $record->email_verified_at !== null)
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-shield-exclamation')
                    ->trueColor('success')
                    ->falseColor('warning'),
                Tables\Columns\TextColumn::make('last_login_at')
                    ->label('Last Login')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->placeholder('Never')
                    ->description(fn (User $record): string => $record->last_login_ip ?? ''),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'user' => 'User',
                        'admin' => 'Admin',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Account Status')
                    ->trueLabel('Active')
                    ->falseLabel('Suspended')
                    ->placeholder('All'),
                TernaryFilter::make('email_verified')
                    ->label('Email Verified')
                    ->trueLabel('Verified')
                    ->falseLabel('Unverified')
                    ->placeholder('All')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('email_verified_at'),
                        false: fn (Builder $query) => $query->whereNull('email_verified_at'),
                    ),
            ])
            ->actions([
                Tables\Actions\Action::make('toggleActive')
                    ->label(fn (User $record): string => $record->is_active ? 'Suspend' : 'Activate')
                    ->icon(fn (User $record): string => $record->is_active ? 'heroicon-o-no-symbol' : 'heroicon-o-check-circle')
                    ->color(fn (User $record): string => $record->is_active ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->modalHeading(fn (User $record): string => $record->is_active ? 'Suspend User' : 'Activate User')
                    ->modalDescription(fn (User $record): string => $record->is_active
                        ? "Are you sure you want to suspend {$record->name}? They will be logged out immediately."
                        : "Re-activate {$record->name}'s account? They will be able to log in again.")
                    ->action(function (User $record) {
                        $record->update(['is_active' => !$record->is_active]);
                        $status = $record->is_active ? 'activated' : 'suspended';
                        Notification::make()
                            ->title("User {$status}")
                            ->body("{$record->name}'s account has been {$status}.")
                            ->success()
                            ->send();
                    })
                    ->visible(fn (User $record): bool => $record->role !== 'admin'),

                Tables\Actions\Action::make('impersonate')
                    ->label('Impersonate')
                    ->icon('heroicon-o-user-circle')
                    ->color('warning')
                    ->url(fn (User $record): string => route('admin.impersonate', $record))
                    ->visible(fn (User $record): bool => $record->role !== 'admin')
                    ->openUrlInNewTab(false),

                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('suspendSelected')
                    ->label('Suspend Selected')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn ($records) => $records->each(fn ($record) => $record->update(['is_active' => false])))
                    ->deselectRecordsAfterCompletion(),
                Tables\Actions\BulkAction::make('activateSelected')
                    ->label('Activate Selected')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn ($records) => $records->each(fn ($record) => $record->update(['is_active' => true])))
                    ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
