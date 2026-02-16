<?php

namespace App\Filament\Widgets;

use App\Models\Deposit;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class LatestActivityWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Latest Activity';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Show the latest users who registered, made deposits, or withdrawal requests
                User::query()
                    ->where('role', 'user')
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('User')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->limit(25),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('accountBalance.current_balance')
                    ->label('Balance')
                    ->money('usd')
                    ->placeholder('$0.00')
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_login_at')
                    ->label('Last Seen')
                    ->since()
                    ->placeholder('Never')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }
}
