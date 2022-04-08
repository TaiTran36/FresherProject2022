<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

            'post_title' => 'required|string|max:191',
            'post_body' => 'required|string|max:65535',
            // 'post_url' => 'required|string|max:191',
            'category_id' => ['required', 'array', 'min:1'],
            // 'category_id.*' => ['required', 'integer', 'exists:categories,id'],

            //
        ];
    }
    public function messages()
    {
        return [
            'post_title.required' => 'Hãy nhập tiêu đề bài viết',
            'post_title.max' => 'Tiêu đề bài viết quá dài',
            'post_body.required' => 'Hãy nhập nội dung bài viết',
            'post_body.max' => 'Nội dung bài viết nhỏ hơn 5000 kí tự',
            'category_id.required' => 'Hãy chọn thể loại'
        ];
    }
}
