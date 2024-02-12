<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class UniqueNameBrandCombination implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        dd($attribute);
        return Product::where('name', $value['name'])
        ->where('brand', $value['brand'])
        ->doesntExist();
    }

    public function message()
    {
        return 'The combination of name and brand already exists.';
    }
}
