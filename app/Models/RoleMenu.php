<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    } 

}
