<?php

namespace App\Filament\Widgets;


use Laraindo\RupiahFormat;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pemasukan = Transaction::incomes()
            ->get()
            ->sum('amount');
        $pengeluaran = Transaction::outcomes()
            ->get()
            ->sum('amount');
        return [
            Stat::make('Total Pemasukan', RupiahFormat::currency($pemasukan)),
            Stat::make('Total Pengeluaran', RupiahFormat::currency($pengeluaran)),
            Stat::make('Selisih', RupiahFormat::currency($pemasukan - $pengeluaran)),
        ];
    }
}
