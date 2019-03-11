<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'firstname' =>['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['sometimes', 'string', 'between:8,20', 'confirmed'],
            'phone'=>['required','phone:BE'],
            'street'=>['required','string','max:255'],
            'streetNum'=>['required','string'],
            'boxNum'=>['sometimes','nullable','string'],
            'cityId'=>['required','integer'],
            'organisationId'=>['required','integer','min:2']
        ];
    }
}
