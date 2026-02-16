<?php

namespace App\Filament\Widgets;

use App\Models\Deposit;
use App\Models\User;
use App\Models\WithdrawalRequest;
use App\Models\AccountBalance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalUsers = User::where('role', 'user')->count();
        $activeUsers = User::where('role', 'user')->where('is_active', true)->count();
        $pendingDeposits = Deposit::where('status', 'pending')->count();
        $pendingWithdrawals = WithdrawalRequest::where('status', 'pending')->count();
        $totalBalance = AccountBalance::sum('current_balance');

        return [
            Stat::make('Total Users', $totalUsers)
                ->description("{$activeUsers} active")
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Pending Deposits', $pendingDeposits)
                ->description('Awaiting confirmation')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color($pendingDeposits > 0 ? 'warning' : 'success')
                ->chart([2, 4, 6, 3, 1, 5, 2]),

            Stat::make('Pending Withdrawals', $pendingWithdrawals)
                ->description('Awaiting approval')
                ->descriptionIcon('heroicon-m-arrow-up-tray')
                ->color($pendingWithdrawals > 0 ? 'danger' : 'success')
                ->chart([3, 5, 2, 4, 6, 1, 3]),

            Stat::make('Platform Balance', '$' . number_format($totalBalance, 2))
                ->description('Total across all users')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart([5, 6, 7, 8, 9, 10, 12]),
        ];
    }
}
