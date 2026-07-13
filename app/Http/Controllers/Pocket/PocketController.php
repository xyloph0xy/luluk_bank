<?php

namespace App\Http\Controllers\Pocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PocketController extends Controller
{
    public function index()
    {
        return view('pocket.index');
    }
}
