<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total',
        'status_id',
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany('CodeCommerce\OrderItem');
    }

    public function status()
    {
        return $this->belongsTo('CodeCommerce\OrderStatus');
    }

    public function user()
    {
        return $this->belongsTo('CodeCommerce\User');
    }
}
