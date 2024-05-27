<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController
{
    protected $transactions;

    public function __construct()
    {
        $this->transactions = new Transactions();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->transactions->index($request->user()->id);
    }

    public function transfer(Request $request)
    {
        $requestBody = json_decode($request->getContent());

        $from = $request->user()->id;
        $to = (int) $requestBody->to;
        $value = (float) $requestBody->value;

        $this->transactions->transfer($from, $to, $value);

        return redirect()->route('home');
    }
}
