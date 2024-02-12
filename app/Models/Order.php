<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','code','total','supplier_id','status_id'
    ];

    public function lists()
    {
        return $this->hasMany('App\Models\OrderList', 'order_id')->orderBy('created_at','DESC');
    } 

    public function supplier()
    {
        return $this->belongsTo('App\Models\SupplierBranch', 'supplier_id', 'id');
    } 

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'status_id', 'id');
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
