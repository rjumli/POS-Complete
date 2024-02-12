<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','quantity','received','price','product_id','status_id','order_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    } 

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'status_id', 'id');
    } 

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
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
