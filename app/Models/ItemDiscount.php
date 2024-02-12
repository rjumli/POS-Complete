<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'start','end','subtype','package_id','product_id','discount_id','type_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    } 

    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id', 'id');
    } 

    public function discount()
    {
        return $this->belongsTo('App\Models\Discount', 'discount_id', 'id');
    } 

    public function type()
    {
        return $this->belongsTo('App\Models\Dropdown', 'type_id', 'id');
    } 

    public function getStartAttribute($value)
    {
        return date('M d, Y', strtotime($value));
    }

    public function getEndAttribute($value)
    {
        return date('M d, Y', strtotime($value));
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
