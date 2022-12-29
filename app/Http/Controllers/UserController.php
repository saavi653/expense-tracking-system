<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\MonthlyExpense;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $expenses=MonthlyExpense::get();
        $comparison[]=0;
        
        for($i=1;$i<12;$i++)
        {
            $previousExpense=$expenses->where('id',$i)->first();
            $expense=$expenses->where('id',$i+1)->first();

            if($expense->expenses)
            {
                if($expense->expenses < $previousExpense->expenses)
                {
                    $diff = $previousExpense->expenses - $expense->expenses;
                    $comparison[] = $diff / $previousExpense->expenses * -100;
                   
                }
                else
                {
                    $diff = $expense->expenses - $previousExpense->expenses;
                    $comparison[] = $diff / $expense->expenses * 100;
                }   
            }
            else
            {
                $comparison[]=0;
            }
        }
        
        return view('user.index', ['expenses'=> $expenses, 'comparison' => $comparison]);
    }
}
