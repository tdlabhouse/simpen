<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_po extends Model
{
    use HasFactory;
    protected $table = "po";
    protected $primamaryKey = "no_po";
    protected $fillable = [];
}
