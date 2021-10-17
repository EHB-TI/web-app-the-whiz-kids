<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Role implements Rule
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
        $validation = false;
        if (in_array($value, ["admin", "editor", "viewer"])){
            $validation = true;
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
        return 'Roles can only be Admin, Editor or Viewer';
    }
}
