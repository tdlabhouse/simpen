<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_do extends Model
{
    use HasFactory;
    protected $table = "do";
    protected $primamaryKey = "no_do";
    protected $fillable = [];
}
