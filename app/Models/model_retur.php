<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_retur extends Model
{
    use HasFactory;
    protected $table = "retur";
    protected $primamaryKey = "no_ret";
    protected $fillable = [];
}
