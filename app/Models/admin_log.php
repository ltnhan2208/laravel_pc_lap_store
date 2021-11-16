<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_log extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='admin_log';
    protected $fillable=['adMa','alChitiet','alNgaygio'];
}
