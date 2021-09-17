<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'min:3|max:15',
            'slug' => 'min:1',
            'price' => 'min:1',
            'description' => 'min:6|max:25',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'max' => ':attribute quá dài',
            'min' => ':attribute không đầy đủ'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
            'slug' => 'Mã định danh',
            'price' => 'Giá',
            'description' => 'Mô tả'
        ];
    }
}
