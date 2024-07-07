<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'name_bn', 'category_id', 'minimum_stock_count'];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');

    }

}
