<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_Resets extends Model
{
    use HasFactory;
    protected $fillable = [
      'created_at','email','token'
    ];
}
