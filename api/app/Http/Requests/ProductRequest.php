<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique:products|min:3|max:15',
            'slug' => 'required',
            'price' => 'required',
            'description' => 'required|min:6|max:25',
        ];
    }

    public function messages()
    {
        return [
            'unique' => ':attribute đã tồn tại',
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
