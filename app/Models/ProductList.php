<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','code','price','stock','reorder','price_id','unit_id','product_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    } 

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'id');
    } 

    public function pricing()
    {
        return $this->belongsTo('App\Models\Dropdown', 'price_id', 'id');
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
