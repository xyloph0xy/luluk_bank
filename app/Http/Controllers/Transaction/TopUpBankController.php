<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopUpBankController extends Controller
{
    public function listBank()
    {
        return view('transaction.top-up.choose-payment');
    }

    public function checkTopupPayment($vaNumber)
    {
        return view('transaction.top-up.check-status', compact('vaNumber'));
    }
   
}
