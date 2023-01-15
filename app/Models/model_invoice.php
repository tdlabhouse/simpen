<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_invoice extends Model
{
    use HasFactory;
    protected $table = "invoice";
    protected $primamaryKey = "no_inv";
    protected $fillable = [];
}
