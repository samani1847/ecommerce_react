<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'cart_detail';
    
    protected $fillable = ['cart_id', 'product_id'];
    
    public function cart()
    {
        return $this->belongsTo('App\Model\Cart');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Admin\Product', 'product_id');
    }
}
