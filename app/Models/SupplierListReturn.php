<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierListReturn extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'managed_by', 'id');
    } 

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'reason_id', 'id');
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
