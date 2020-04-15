<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineRequest extends Model
{
    protected $table = "linea_pedidos";
//    
//    public function request() {
//        return $this->hasMany('App\request');
//    }
     public function product() {
        return $this->hasMany('App\Product');
    }
}
