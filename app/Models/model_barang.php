<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $primamaryKey = "kd_barang";
    protected $fillable = [];
}
