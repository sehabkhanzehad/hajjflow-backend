<?php

namespace App\Http\Controllers\Api\Web\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function overview(): JsonResponse
    {
        $totalTransactions = Transaction::count();
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $currentBalance = Section::all()->sum(fn($section) => $section->currentBalance());

        $today = now()->toDateString();
        $todayTransactionsCount = Transaction::where('date', $today)->count();
        $todayIncome = Transaction::where('date', $today)->where('type', 'income')->sum('amount');
        $todayExpense = Transaction::where('date', $today)->where('type', 'expense')->sum('amount');

        // Additional metrics
        $averageTransactionAmount = Transaction::avg('amount') ?? 0;
        $profitLoss = $totalIncome - $totalExpense;
        $incomePercentage = $totalIncome > 0 ? round(($totalIncome / ($totalIncome + $totalExpense)) * 100, 1) : 0;
        $expensePercentage = $totalExpense > 0 ? round(($totalExpense / ($totalIncome + $totalExpense)) * 100, 1) : 0;

        // Last 7 days transactions
        $last7DaysCount = Transaction::where('date', '>=', now()->subDays(7))->count();
        $last7DaysIncome = Transaction::where('date', '>=', now()->subDays(7))->where('type', 'income')->sum('amount');
        $last7DaysExpense = Transaction::where('date', '>=', now()->subDays(7))->where('type', 'expense')->sum('amount');

        // Transaction type distribution
        $incomeCount = Transaction::where('type', 'income')->count();
        $expenseCount = Transaction::where('type', 'expense')->count();

        // Monthly trends for last 12 months
        $monthlyData = Transaction::selectRaw('YEAR(date) as year, MONTH(date) as month, type, SUM(amount) as total')
            ->where('date', '>=', now()->subMonths(12))
            ->groupBy('year', 'month', 'type')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->groupBy(['year', 'month']);

        $trends = [];
        foreach ($monthlyData as $year => $months) {
            foreach ($months as $month => $data) {
                $income = $data->where('type', 'income')->sum('total');
                $expense = $data->where('type', 'expense')->sum('total');
                $trends[] = [
                    'month' => $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT),
                    'income' => $income,
                    'expense' => $expense,
                    'net' => $income - $expense,
                ];
            }
        }

        // Top sections by transaction count
        $topSections = Transaction::selectRaw('section_id, COUNT(*) as count')
            ->groupBy('section_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->with('section')
            ->get()
            ->map(fn($t) => ['section' => $t->section->name, 'count' => $t->count]);

        return response()->json([
            'total_transactions' => $totalTransactions,
            'total_income' => (float) $totalIncome,
            'total_expense' => (float) $totalExpense,
            'current_balance' => (float) $currentBalance,
            'today_transactions_count' => $todayTransactionsCount,
            'today_income' => (float) $todayIncome,
            'today_expense' => (float) $todayExpense,
            'average_transaction_amount' => round($averageTransactionAmount, 2),
            'profit_loss' => (float) $profitLoss,
            'income_percentage' => $incomePercentage,
            'expense_percentage' => $expensePercentage,
            'last_7_days_count' => $last7DaysCount,
            'last_7_days_income' => (float) $last7DaysIncome,
            'last_7_days_expense' => (float) $last7DaysExpense,
            'income_count' => $incomeCount,
            'expense_count' => $expenseCount,
            'monthly_trends' => $trends,
            'top_sections' => $topSections,
        ]);
    }
}
