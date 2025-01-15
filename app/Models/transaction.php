<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
      //FILLABLE
      protected $fillable = [
        'credit', 
        'debit', 
        'account',
        'desciption',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
