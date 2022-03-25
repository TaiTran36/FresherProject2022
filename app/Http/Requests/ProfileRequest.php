<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'date_of_birth'=> ['required','date'],
            'nickname'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string'],
            'address'=> ['required', 'string'],
            'phone_number'=> ['required', 'string', 'max:11'],
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ];
        
    }
}
