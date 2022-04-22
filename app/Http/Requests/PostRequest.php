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
            'title' => ['string', 'max:50', 'nullable'], 
            'url' => ['string', 'max: 50', 'nullable'], 
            'category' => ['required', 'min:1'],
            'image' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048', 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000', 'nullable'],
            'content' => ['required', 'string', 'min: 200', 'max: 10000'], 
        ];
    }
}
