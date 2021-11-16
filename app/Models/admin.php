<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table='admin';
    protected $primaryKey='adMa';
    protected $fillable=['adMa','adTen','adTaikhoan','adMatkhau','adSdt','adEmail','adQuyen','adHinh','adDiachi','adHinhcmnd'];


    public function getAuthPassword()
    {
        return $this->adMatkhau;
    }
}
