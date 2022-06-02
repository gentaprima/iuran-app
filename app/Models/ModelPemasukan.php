<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPemasukan extends Model
{
    protected $table = "tbl_pemasukan";
    protected $guarded = [];
    public $timestamps = false;
}
