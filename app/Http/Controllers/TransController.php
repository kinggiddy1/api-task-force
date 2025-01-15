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
            'description' => 'required|string',
        ]);

       // $product = Product::create($fields);
        $transaction = $request->user()->transaction()->create($fields);
        
        return response()->json(['Credit' => $transaction], 201);
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
