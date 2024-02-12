<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageList extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity','price','total','product_id','package_id'
    ];

    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id', 'id');
    } 

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    } 
}
