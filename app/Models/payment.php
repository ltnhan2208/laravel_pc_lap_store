<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table ='payments';
    protected $primaryKey='pmId';
    protected $fillable=['pmId','pmName','endpoint','partnerCode','accessKey','serectKey','extraData','pmStatus'];
}
