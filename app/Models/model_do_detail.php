<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_do_detail extends Model
{
    use HasFactory;
    protected $table = "do_detail";
    protected $primamaryKey = "id";
    protected $fillable = [];
}
