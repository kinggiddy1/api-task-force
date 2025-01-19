<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Limit;
use Illuminate\Support\Facades\Validator;
class LimitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = Limit::latest()->first(); 

        if($limit ->count()>0){
            return response()->json(['limitAmount' => $limit], 200);
        }else{
            return response()->json(['limitAmount' => 'There is No Limit Found'], 200);
        }
       
    }

    public function limit(Request $request)
    {
       
        $fields = $request->validate([
            'limit_amount' => 'numeric',
        ]);

        $limit = Limit::create($fields);
        
        return response()->json(['limitAmount' => $limit], 201);
    }
    
}
