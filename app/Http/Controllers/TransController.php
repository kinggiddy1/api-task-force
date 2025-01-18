<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class TransController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::latest()->get(); 

        if($transactions ->count()>0){
            return response()->json(['transactions' => $transactions], 200);
        }else{
            return response()->json(['transactions' => 'There is No Transaction Found'], 200);
        }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'credit' => 'numeric',
            'debit' => 'numeric',
            'account' => 'required|string',
            'category' => 'string',
            'description' => 'string',
        ]);

      
        $transaction = $request->user()->transaction()->create($fields);
        
        return response()->json(['Credit' => $transaction], 201);
    }

      /**
     * Display the specified resource.
     */
    public function totalcredit()
    {
        $totalCredit = Transaction::sum('credit');
        return response()->json(['totalCredit' => $totalCredit]);
    }

    public function totaldebit()
    {
        $totalDebit = Transaction::sum('debit');
        return response()->json(['totalDebit' => $totalDebit]);
    }

    public function balance()
    {
        $balance = (Transaction::sum('credit') - Transaction::sum('debit'));
        return response()->json(['Balance' => $balance]);
    }


    public function bank()
    {
        $totalBankCredit = Transaction::where('account', 'Bank')->sum('credit');
        $totalBankDebit = Transaction::where('account', 'Bank')->sum('debit');
        $totalBank = ($totalBankCredit - $totalBankDebit);
        return response()->json(['TotalBank' => $totalBank]);
    }
    

    public function cash()
    {
        $totalCashCredit = Transaction::where('account', 'Cash')->sum('credit');
        $totalCashDebit = Transaction::where('account', 'Cash')->sum('debit');
        $totalCash = ($totalCashCredit - $totalCashDebit);
        return response()->json(['TotalCash' => $totalCash]);
    }

    public function momo()
    {
        $totalMoMoCredit = Transaction::where('account', 'MoMo')->sum('credit');
        $totalCashDebit = Transaction::where('account', 'MoMo')->sum('debit');
        $totalmomo = ($totalMoMoCredit - $totalCashDebit);
        return response()->json(['TotalMoMo' => $totalmomo]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}