<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','name','value','from','to','type_id','subtype_id','based_id','is_active'
    ];

    public function based()
    {
        return $this->belongsTo('App\Models\Dropdown', 'based_id', 'id');
    } 

    public function type()
    {
        return $this->belongsTo('App\Models\Dropdown', 'type_id', 'id');
    } 

    public function subtype()
    {
        return $this->belongsTo('App\Models\Dropdown', 'subtype_id', 'id');
    } 

    public function products()
    {
        return $this->hasMany('App\Models\ProductDiscount', 'discount_id');
    } 

    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
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
