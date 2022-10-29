<?php

namespace App\Models;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasSku;
    protected $table = 'products';
    protected $fillable = [
        'category_id', 'subcategory_id', 'product_name', 'images','price','slug','unique_id'
    ];
    public function category()
    {
        return $this->morphToMany(category::class, 'catagorizable', 'categorizables');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategories()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }
    public function products()
    {
        return $this->morphTo();
    }
}
