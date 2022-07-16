<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class PostEditRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:users,name,' . $this->user->id,
            'email' => 'required|unique:users,email,' . $this->user->id,
            'group_id' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'Địa chỉ Email',
            'name' => 'Tên',
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