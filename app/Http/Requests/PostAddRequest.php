<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostAddRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'group_id' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'Địa chỉ Email',
            'name' => 'Tên',
            'password' => 'Mật khẩu',
            'group_id' => 'Nhóm',
        ];
    }
    public function messages()
    {
        return [
            'required' => ' :attribute không được để trống',
            'unique' => ' :attribute đã được sử dụng',
            'max' => ' :attribute quá dài',
        ];
    }
}