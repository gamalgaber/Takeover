<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): view
    {
        $transactions = Transaction::all();
        return view('admin.transaction.index', compact('transactions'));
    }
}
