<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    public function index(Request $request){
        $expensive = $request -> input('expensive');
        
        $query = Expense::query();

        $expensive = $query ->get();

        return view('expenses.index',compact('expensive'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('expenses.create',compact('categories'));
    }

    public function store(ExpenseRequest $request)
    {
        $validateData = $request->validated();
        Expense::create($validateData);
        return redirect()->route('expenses.index');
    }

    public function show(Expense $expense)
    {
        //
    }

    public function edit(Expense $expense)
    {
        //
    }

    public function update(Request $request, Expense $expense)
    {
        //
    }

    public function destroy(Expense $expense)
    {
        //
    }

}
