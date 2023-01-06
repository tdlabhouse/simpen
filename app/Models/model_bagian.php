<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_bagian extends Model
{
    use HasFactory;
    protected $table = "bagian";
    protected $primamaryKey = "kd_bagian";
    protected $fillable = [];
}
