<?php

namespace App\Rules;

use App\Models\Trip;
use Illuminate\Contracts\Validation\Rule;

class NoActiveTrips implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $activeTrips = Trip::where('has_departed', 0)->where('is_completed', 0)->count();
        return $activeTrips === 0;
    }

    public function message()
    {
        return 'You cannot add a new trip while there are active trips.';
    }
}
