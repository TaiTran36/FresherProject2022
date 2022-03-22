<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'dob' => 'required|date_format:d/m/Y',
            'nickname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'description' => 'required|string|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required|string|max:1000',
            'phone' => 'required|digits:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Hãy nhập họ và tên",
            'name.max' => "Họ và tên của bạn quá dài",
            'dob.required' => "Hãy nhập ngày tháng năm sinh",
            'dob.date_format' => "Ngày tháng năm không đúng định dạng",
            'nickname.required' => "Hãy nhập biệt danh",
            'nickname.max' => "Biệt danh của bạn quá dài",
            'email.required' => 'Hãy nhập email',
            'email.email' => 'Email không đúng định dạng',
            'description.required' => "Hãy nhập giới thiệu bản thân",
            'description.max' => "Giới thiệu bản thân của bạn quá dài",
            'avatar.image' => "Avatar phải là ảnh",
            'avatar.mimes' => "Hãy chọn ảnh có phần mở rộng là jpeg, png, jpg, gif hoặc svg",
            'address.required' => "Hãy nhập địa chỉ",
            'address.max' => "Địa chỉ của bạn quá dài",
            'phone.required' => "Hãy nhập số điện thoại",
            
        ];
    }

    // if ($request->input('btn_edit')) {
    //     $request->validate(
    //         [

    //         ],
    //         [
    //             'required' => ':attribute không được để trống',
    //             'min' => ':attribute có độ dài ít nhất :min kí tự',
    //             'max' => ':attribute có độ dài ít nhất :max kí tự'
    //         ],
    //         [
    //             'name' => 'Tên người dùng',
    //             'dob' => 'Ngày sinh',
    //             'nickname' => 'Biệt danh',
    //             'descrition' => 'Giới thiệu bản thân',
    //             'avatar' => 'Avatar',
    //             'phone' => 'Số điện thoại'
    //         ]
    //     );
    // }
}
