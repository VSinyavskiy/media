<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueCombination implements Rule
{
    /**
    * Define model for check unique
    */
    public $model;

    /**
    * Define fields for unique combination check
    */
    public $fields;


    public function __construct($model, $fields = [])
    {
        $this->model  = $model;
        $this->fields = $fields;
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
        $baseRaw = $this->model::where($attribute, 'like', $value ?? '')->first();

        $rawsForCheck = [];
        foreach ($this->fields as $attributel => $value) {
            $raw = $this->model::where($attributel, 'like', $value ?? '')->first();

            if (is_null($raw)) {
                $nullCheck = true;
                break;
            } else {
                $rawsForCheck[$raw->id] = $raw;
            }
        }       

        if (isset($baseRaw) && isset($nullCheck)) {
            return false;
        }

        if (isset($baseRaw) && count($rawsForCheck) != 1) {
            return false;
        }

        if (isset($baseRaw) && count($rawsForCheck) == 1 && $baseRaw->id !== head($rawsForCheck)->id) {
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
        $absentTranslates                 = array_diff_key($this->fields, __('validation.attributes')); 
        $translateOrFieldsName            = array_merge($this->fields, array_combine(array_flip($absentTranslates), array_flip($absentTranslates)), __('validation.attributes'));
        $otherFieldsTranslateOrFieldsName = array_intersect_key($translateOrFieldsName, $this->fields);

        return str_replace(':other', implode(', ', array_keys(array_flip($otherFieldsTranslateOrFieldsName))), __('validation.unique_combination'));
    }
}