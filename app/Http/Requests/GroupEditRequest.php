<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupEditRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:groups',
        ];
    }
    public function attributes()
    {
        return [

            'name' => 'Tên',

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