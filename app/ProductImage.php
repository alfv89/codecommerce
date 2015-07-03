<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'name',
        'extension',
        'mime',
        'size',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('CodeCommerce\Product');
    }
}
