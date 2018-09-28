<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueWithoutSpace implements Rule
{
    /**
    * Define model for check unique
    */
    public $model;

    public function __construct($model)
    {
        $this->model  = $model;
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
        return is_null($this->model::where($attribute, withoutSpace($value))->first()) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.unique');
    }
}