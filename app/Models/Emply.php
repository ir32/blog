<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emply extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'name', 'age'
    ];
}
