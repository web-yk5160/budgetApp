<?php

namespace App\Http\Controllers;

use App\Category;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Category $category)
    {
        $transactionsQuery = Transaction::byCategory($category);
        $currentMonth = request('month') ?: Carbon::now()->format('M');

        if (request()->has('month')) {
            $transactionsQuery->byMonth(request('month'));
        }
        else {
            $transactionsQuery->byMonth() ;
        }

        $transactions = $transactionsQuery->paginate();

        return view('transactions.index', compact('transactions', 'currentMonth'));
    }

    public function create()
    {
        $categories = Category::all();
        $transaction = new Transaction();
        return view('transactions.create', compact('categories', 'transaction'));
    }

    public function store()
    {
        $this->validate(request(), [
            'description' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric'
        ]);

        Transaction::create(request()->all());
        return redirect('/transactions');
    }


    public function update(Transaction $transaction)
    {
        $this->validate(request(), [
            'description' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric'
        ]);

        $transaction->update(request()->all());
        return redirect('/transactions');
    }


    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect('/transactions');
    }
}
