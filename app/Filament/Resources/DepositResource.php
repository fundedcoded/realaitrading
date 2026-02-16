<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepositResource\Pages;
use App\Filament\Resources\DepositResource\RelationManagers;
use App\Models\Deposit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('tx_hash')
                    ->label('Transaction Hash')
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount_btc')
                    ->label('Amount (BTC)')
                    ->numeric()
                    ->required()
                    ->step(0.00000001),
                Forms\Components\TextInput::make('amount_usd')
                    ->label('Amount (USD)')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'rejected' => 'Rejected',
                    ])
                    ->required()
                    ->default('pending')
                    ->live()
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state === 'confirmed' && $record) {
                            \Filament\Notifications\Notification::make()
                                ->title('Deposit Will Be Confirmed')
                                ->body('User balance will be updated upon saving.')
                                ->info()
                                ->send();
                        }
                    }),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535),
                Forms\Components\DateTimePicker::make('confirmed_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_btc')
                    ->label('BTC')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_usd')
                    ->label('USD')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('confirm')
                    ->label('Confirm')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Deposit')
                    ->modalDescription(fn (Deposit $record): string =>
                        "Confirm deposit of $" . number_format($record->amount_usd, 2) . " for {$record->user->name}?")
                    ->action(function (Deposit $record) {
                        // Credit user balance
                        $balanceService = app(\App\Services\BalanceService::class);
                        $balanceService->credit($record->user, $record->amount_usd, 'deposit', [
                            'deposit_id' => $record->id,
                            'tx_hash' => $record->tx_hash,
                            'amount_btc' => $record->amount_btc,
                        ]);

                        $record->update([
                            'status' => 'confirmed',
                            'confirmed_at' => now(),
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Deposit Confirmed')
                            ->body("$" . number_format($record->amount_usd, 2) . " credited to {$record->user->name}")
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Deposit $record): bool => $record->status === 'pending'),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Deposit')
                    ->modalDescription(fn (Deposit $record): string =>
                        "Reject deposit of $" . number_format($record->amount_usd, 2) . " for {$record->user->name}?")
                    ->form([
                        Forms\Components\Textarea::make('notes')
                            ->label('Reason for rejection')
                            ->rows(2)
                            ->required(),
                    ])
                    ->action(function (Deposit $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'notes' => $data['notes'],
                        ]);

                        // Log rejection so it appears in user activity
                        \App\Models\TransactionLog::create([
                            'user_id' => $record->user_id,
                            'type' => 'deposit_rejected',
                            'amount' => 0,
                            'balance_after' => $record->user->accountBalance->current_balance ?? 0,
                            'meta' => [
                                'deposit_id' => $record->id,
                                'original_amount' => $record->amount_usd,
                                'reason' => $data['notes'],
                            ],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Deposit Rejected')
                            ->body("Deposit rejected for {$record->user->name}")
                            ->warning()
                            ->send();
                    })
                    ->visible(fn (Deposit $record): bool => $record->status === 'pending'),

                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDeposits::route('/'),
            'create' => Pages\CreateDeposit::route('/create'),
            'edit' => Pages\EditDeposit::route('/{record}/edit'),
        ];
    }
}
