<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
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
    public function rules(Request $request)
    {
        // dd($request->all());
        return [
            'email'           => 'required|max:255|email',
            'password'           => 'required|min:8',
        ];
        

    }
    public function messages()
    {
        // return ;
        return [
            'email.required' => 'Hãy nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.min' => 'Mật khẩu phải có ít nhất 8 kí tự',
            'password.confirmed' => 'Mật khẩu không đúng',
        ];
    }
}
