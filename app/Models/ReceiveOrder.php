<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','quantity','price','status_id','orderlist_id'
    ];
}
