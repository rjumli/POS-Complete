<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','code','brand','name','reorder','lead','demand','safety','stock','price','size','warranty','category_id','unit_id','pricing_id','percentage_id','description'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    } 

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'id');
    } 

    public function pricing()
    {
        return $this->belongsTo('App\Models\Dropdown', 'pricing_id', 'id');
    } 

    public function percentage()
    {
        return $this->belongsTo('App\Models\Pricing', 'percentage_id', 'id');
    } 

    public function orders()
    {
        return $this->hasMany('App\Models\OrderList', 'product_id')->orderBy('created_at','DESC');
    } 

    public function sales()
    {
        return $this->hasMany('App\Models\SaleList', 'product_id')->orderBy('created_at','DESC');
    } 

    public function total()
    {
        return $this->hasMany('App\Models\SaleList', 'product_id')->sum('total');
    } 

    public function quantities()
    {
        return $this->hasMany('App\Models\SaleList', 'product_id')->sum('quantity');
    } 

    public function discounts()
    {
        return $this->hasMany('App\Models\ItemDiscount', 'product_id')->where('is_active',1);
    } 

    public function adjustments()
    {
        return $this->hasMany('App\Models\ProductAdjustment', 'product_id');
    } 

    // public function lists()
    // {
    //     return $this->hasMany('App\Models\ProductList', 'product_id')->orderBy('created_at','DESC');
    // } 

    public function setBrandAttribute($value)
    {
        $this->attributes['brand'] = ucwords(strtolower($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }
}
