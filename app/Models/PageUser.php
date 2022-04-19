<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        $this->hasOne(User::class);
    }
}
