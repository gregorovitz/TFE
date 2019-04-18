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
            'name' => [ 'string', 'max:255'],
            'firstname' =>['string','max:255'],
            'email' => [ 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['sometimes', 'string', 'between:8,20', 'confirmed'],
            'phone'=>['phone:BE'],
            'street'=>['string','max:255'],
            'streetNum'=>['string'],
            'boxNum'=>['sometimes','nullable','string'],
            'cityId'=>['integer'],
            'organisationId'=>['required_without:organisationAdd','integer','min:2'],
            'organisationAdd'=>['sometimes','nullable','string','max:255']
        ];
    }
}
