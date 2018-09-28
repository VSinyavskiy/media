<?php

namespace App\Http\Requests\App\Auth;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;
use App\Rules\UniqueCombination;

class SocialRegisterRequest extends FormRequest
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
            'phone'                 => ['required', 'confirmed', 'min:8', 'max:191', 'regex:/(^[0-9 +]+$)+/', new UniqueCombination(
                                        User::class, [
                                            'email' => $this->request->get('email'),
                                        ])],
            'phone_confirmation'    => 'max:191',
            'city'                  => 'required|max:191',
            'email'                 => ['required', 'email', 'max:191', new UniqueCombination(
                                        User::class, [
                                            'phone' => $this->request->get('phone'),
                                        ])],
        ];
    }
}
