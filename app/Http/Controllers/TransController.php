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
        $transactions = Transaction::all(); 

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
        $totalBank = Transaction::where('account', 'Bank')->sum('credit');
        return response()->json(['TotalBank' => $totalBank]);
    }
    

    public function cash()
    {
        $totalCash = Transaction::where('account', 'Cash')->sum('credit');
        return response()->json(['TotalCash' => $totalCash]);
    }

    public function momo()
    {
        $totalmomo = Transaction::where('account', 'momo')->sum('credit');
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