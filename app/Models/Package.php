<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','name','price','stock','information','category_id','is_available'
    ];

    public function lists()
    {
        return $this->hasMany('App\Models\PackageList', 'package_id')->orderBy('created_at','DESC');
    } 

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    } 

    public function discounts()
    {
        return $this->hasMany('App\Models\ItemDiscount', 'package_id')->where('is_active',1);
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
