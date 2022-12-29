<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Expense;
use App\Models\MonthlyExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    public function create()
    {
        $categories = Category::get();
        
        return view('categories.expenses.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $categories_id = Category::get()->pluck('id');

        $attributes = $request->validate([
            'category_id' => ['required',
                Rule::in($categories_id)
            ],
            'name' => 'required|alpha|string|min:3|max:255',
            'cost' => 'required|integer|gt:0',
            'date' => 'required|after:2021-12-31|before:2023-01-01',
            'file' => 'required|mimes:jpeg,jpg,png,pdf'
        ]);

        $file=request()->file->store('/files');

        $attributes += [
            
            'month' => Carbon::createFromFormat('Y-m-d', $attributes['date'])->format('F'),
            'url' => $file
        ];
        
        $expense = Expense::create($attributes);

        MonthlyExpense::AddExpense($expense->month);

        if ($request['submit'] == 'ADD') 
        {
            return redirect()->route('user.dashboard')
                ->with('success', 'expense added successfully');
        }

        return back()->with('success', 'expense added successfully');
    }

    public function edit(Expense $expense)
    {
        $categories = Category::get();

        return view('categories.expenses.edit', [
            'categories'=> $categories, 
            'expense' => $expense
        ]);
    }
    public function update(Expense $expense, Request $request)
    {
        
        $categories_id = Category::get()->pluck('id');

        $attributes = $request->validate([
            'category_id' => ['required',
                Rule::in($categories_id)
            ],
            'name' => 'required|string|min:3|max:255',
            'cost' => 'required|integer|gt:0',
            'date' => 'required|after:2021-12-31|before:2023-01-01'
        ]);

        $attributes += [
            'month' => Carbon::createFromFormat('Y-m-d', $attributes['date'])->format('F'),
        ];
        
        MonthlyExpense::MonthlyExpenseUpdate($expense);

        $expense->update($attributes);

        MonthlyExpense::AddExpense($expense->month);

        return redirect()->route('expenses.show')
            ->with('success', 'expense updated successfully');
    }

    public function show()
    {
        $expenses = Expense::filter(request([
            'sort',
            'from',
            'to',
            'search'
        ]))->simplePaginate(9);

        return view('categories.expenses.show', ['expenses' => $expenses]);
    }

    public function monthWiseShow(Request $request)
    {
        $categories=Category::get();
        $expenses=Expense::where('month', $request->name)->get()->groupBy('category_id');
        $totalcost = MonthlyExpense::where('name', $request->name)->sum('expenses');
     
        return view('categories.expenses.monthWiseShow',[
            
            'expenses' => $expenses,
            'categories' => $categories,
            'totalcost' => $totalcost
        ]);
    }
}
