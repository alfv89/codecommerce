<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'featured',
        'recommend',
        'category_id'
    ];

    /*
    * RELATIONS
    */

    public function images()
    {
        return $this->hasMany('CodeCommerce\ProductImage');
    }

    public function category()
    {
        return $this->belongsTo('CodeCommerce\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('CodeCommerce\Tag');
    }

    /*
    * QUERY SCOPES
    */

    public function scopeFeatured($query)
    {
        return $query->where('featured', '=', 1);
    }

    public function scopeRecommended($query)
    {
        return $query->where('recommend', '=', 1);
    }

    public function scopeOfCategory($query, $id)
    {
        return $query->where('category_id', '=', $id);
    }

    public function scopeOfTag($query, $id)
    {
        return $query->whereHas('tags', function($q) use ($id){
            $q->where('id', '=', $id);
        });
    }

    /*
     * ATTRIBUTES
     */

    public function getFirstImageAttribute()
    {
        $images = $this->images->lists('name')->toArray();

        if (count($images) > 0) {
            return 'uploads/' . $images[0];
        } else {
            return 'images/no-img.jpg';
        }
    }

    public function getTagListAttribute()
    {
        $tags = $this->tags->lists('name')->toArray();

        return implode(', ', $tags);
    }
}
