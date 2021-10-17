<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotUnassigned implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $validation = true;
        if (count($value) == 1 && in_array("1", $value)){
            $validation = false;
        }
        return $validation;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please provide at least one group, not including Unassigned';
    }
}
