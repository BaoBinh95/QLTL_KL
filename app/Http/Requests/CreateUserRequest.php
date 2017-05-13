<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required:users,name',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa Nhập Tên Nhân Viên',
            'email.required' => 'Chưa Nhập Email',
            'email.unique' => 'Email Này Đã Tồn Tại',
            'email.email' => 'Email không đúng định dạng',
        ];
    }
}
