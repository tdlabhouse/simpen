<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_fpb_detail extends Model
{
    use HasFactory;
    protected $table = "fpb_detail";
    protected $primamaryKey = "id";
    protected $fillable = [];
}
