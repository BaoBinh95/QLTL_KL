<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDepartmentRequest extends FormRequest
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
            'name' => 'required|unique:departments,name',
            'alias' => 'required|unique:departments,alias',
            'address' => 'required:departments,address',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên phòng ban',
            'alias.required' => 'Chưa nhập tên viết tắt',
            'address.required' => 'Chưa nhập địa chỉ',
            'name.unique' => 'Tên Phòng Ban Này Đã Tồn Tại',
            'alias.unique' => 'Tên Viết Tắt Này Đã Tồn Tại',
        ];
    }
}
