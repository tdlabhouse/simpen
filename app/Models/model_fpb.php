<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_fpb extends Model
{
    use HasFactory;
    protected $table = "fpb";
    protected $primamaryKey = "no_fpb";
    protected $fillable = [];
}
