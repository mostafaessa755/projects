<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orderitems(){
        return $this->hasMany(Orderitems::class);
    }
    public function products(){
        return $this->belongsToMany(product::class,'orderitems');
    }
}
