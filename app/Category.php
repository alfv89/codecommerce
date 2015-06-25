<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed description
 */
class Category extends Model
{
    protected $fillable = ['name', 'description'];
}
