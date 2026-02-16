<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawalRequestResource\Pages;
use App\Models\WithdrawalRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class WithdrawalRequestResource extends Resource
{
    protected static ?string $model = WithdrawalRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Withdrawals';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Withdrawal Details')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->required()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('btc_address')
                            ->label('BTC Address')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Processing')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('pending')
                            ->live(),
                        Forms\Components\DateTimePicker::make('processed_at')
                            ->label('Processed At'),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Internal notes about this withdrawal (not visible to user).'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('amount')
                    ->money('usd')
                    ->sortable()
                    ->color('danger'),
                Tables\Columns\TextColumn::make('btc_address')
                    ->label('BTC Address')
                    ->limit(20)
                    ->tooltip(fn (WithdrawalRequest $record): string => $record->btc_address)
                    ->copyable()
                    ->icon('heroicon-m-clipboard'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('admin_notes')
                    ->label('Notes')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('processed_at')
                    ->label('Processed')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->placeholder('Not yet'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Requested')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Withdrawal')
                    ->modalDescription(fn (WithdrawalRequest $record): string =>
                        "Approve withdrawal of $" . number_format($record->amount, 2) . " for {$record->user->name}?")
                    ->form([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes (optional)')
                            ->rows(2),
                    ])
                    ->action(function (WithdrawalRequest $record, array $data) {
                        // Debit user balance
                        $balanceService = app(\App\Services\BalanceService::class);
                        try {
                            $balanceService->debit($record->user, $record->amount, 'withdrawal', [
                                'withdrawal_id' => $record->id,
                                'btc_address' => $record->btc_address,
                                'status' => 'approved',
                            ]);
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Insufficient Balance')
                                ->body("User does not have enough balance for this withdrawal.")
                                ->danger()
                                ->send();
                            return;
                        }

                        $record->update([
                            'status' => 'approved',
                            'admin_notes' => $data['admin_notes'] ?? $record->admin_notes,
                            'processed_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Withdrawal Approved')
                            ->body("$" . number_format($record->amount, 2) . " withdrawal approved for {$record->user->name}")
                            ->success()
                            ->send();
                    })
                    ->visible(fn (WithdrawalRequest $record): bool => $record->status === 'pending'),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Withdrawal')
                    ->modalDescription(fn (WithdrawalRequest $record): string =>
                        "Reject withdrawal of $" . number_format($record->amount, 2) . " for {$record->user->name}?")
                    ->form([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Reason for rejection')
                            ->rows(2)
                            ->required(),
                    ])
                    ->action(function (WithdrawalRequest $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'admin_notes' => $data['admin_notes'],
                            'processed_at' => now(),
                        ]);

                        // Log the rejection so it shows in user's activity
                        \App\Models\TransactionLog::create([
                            'user_id' => $record->user_id,
                            'type' => 'withdrawal_rejected',
                            'amount' => 0,
                            'balance_after' => $record->user->accountBalance->current_balance ?? 0,
                            'meta' => [
                                'withdrawal_id' => $record->id,
                                'original_amount' => $record->amount,
                                'reason' => $data['admin_notes'],
                            ],
                        ]);

                        Notification::make()
                            ->title('Withdrawal Rejected')
                            ->body("$" . number_format($record->amount, 2) . " withdrawal rejected for {$record->user->name}")
                            ->warning()
                            ->send();
                    })
                    ->visible(fn (WithdrawalRequest $record): bool => $record->status === 'pending'),

                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListWithdrawalRequests::route('/'),
            'create' => Pages\CreateWithdrawalRequest::route('/create'),
            'edit' => Pages\EditWithdrawalRequest::route('/{record}/edit'),
        ];
    }
}
