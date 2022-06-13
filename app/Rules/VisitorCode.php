<?php

namespace App\Rules;

use App\Position;
use Illuminate\Contracts\Validation\Rule;

class VisitorCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $positions = Position::where('Consultant_code', $value)->count();
        if ($positions < 2)
            return true;

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute وارد خالی نمی‌باشد.';
    }
}
