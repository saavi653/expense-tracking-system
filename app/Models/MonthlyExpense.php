<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyExpense extends Model
{
    use HasFactory;

    public function scopeAddExpense($query, $month)
    {
        $totalExpense = Expense::where('month', $month)->sum('cost');

        $query->where('name', $month)->update([
            'expenses' => $totalExpense
        ]);
    }

    public function scopeMonthlyExpenseUpdate($query, $oldMonth)
    {
        $query->where('name', $oldMonth->month)
            ->decrement('expenses', $oldMonth->cost);
    }
}
