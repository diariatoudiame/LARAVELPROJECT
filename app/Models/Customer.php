<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'firstname',
        'address',
        'phone_number',
        'gender',
    ];
    protected $casts = [
        'gender' => 'string',
    ];
}
