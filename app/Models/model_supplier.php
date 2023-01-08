<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_supplier extends Model
{
    use HasFactory;
    protected $table = "supplier";
    protected $primamaryKey = "kd_supplier";
    protected $fillable = [];
}
