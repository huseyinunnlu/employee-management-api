<?php

namespace App\Rules;

use App\Models\ForeignLanguage;
use Illuminate\Contracts\Validation\Rule;

class UniqueForOneData implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
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
        $data = ForeignLanguage::where($attribute, $value)->where('user_id', $this->user_id)->first();
        if ($data) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.attribute-name.UniqueForOneData');
    }
}
