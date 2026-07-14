<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function submitTransfer()
    {
        return view('transaction.transfer-bank.submit');
    }
}
