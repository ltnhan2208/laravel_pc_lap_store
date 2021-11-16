<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhacungcap extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='nhacungcap';
    protected $primaryKey='nccMa';
    protected $fillable=['nccMa','nccTen','nccSdt','nccDiachi','nccTinhtrang'];
}
