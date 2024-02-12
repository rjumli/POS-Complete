<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','subtotal','tax','discount','total','cash','change','status_id','payment_id','customer_id','discount_id','managed_by'
    ];

    public function lists()
    {
        return $this->hasMany('App\Models\SaleList', 'sale_id')->orderBy('created_at','DESC');
    } 

    public function discounted()
    {
        return $this->belongsTo('App\Models\Discount', 'discount_id', 'id');
    } 

    public function payment()
    {
        return $this->belongsTo('App\Models\Discount', 'payment_id', 'id');
    } 

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'status_id', 'id');
    } 

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    } 

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'managed_by', 'id');
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
