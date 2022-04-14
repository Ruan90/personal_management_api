<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ForeignKeyExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($object)
    {
        $this->object = $object;
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
        return $this->object::find($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute inexistente!';
    }
}
