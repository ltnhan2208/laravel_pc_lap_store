<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tintuc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tintuc';
    protected $primaryKey='ttMa';
    protected $fillable=['ttMa','ttTieude','ttNoidung','ttNgaydang','ttTinhtrang','ttLuotxem','adMa'];
}
