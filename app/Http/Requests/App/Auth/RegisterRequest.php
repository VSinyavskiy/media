<?php

namespace App\Http\Requests\App\Auth;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;
use App\Rules\UniqueWithoutSpace;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'            => 'required|max:191',
            'last_name'             => 'required|max:191',
            'phone'                 => ['required', 'confirmed', 'max:191', 'regex:/(^[0-9 +]+$)+/', new UniqueWithoutSpace(User::class)],
            'phone_confirmation'    => 'max:191',
            'city'                  => 'required|max:191',
            'email'                 => 'required|email|unique:users,email|max:191',
            'password'              => 'required|confirmed|min:' . User::DEFAULT_PASSWORD_LENGTH,
            'password_confirmation' => 'min:' . User::DEFAULT_PASSWORD_LENGTH,
        ];
    }
}
