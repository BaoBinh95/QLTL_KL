<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTypeDocumentRequest extends FormRequest
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
            'name' => 'required|unique:type_documents,name',
            'description' => 'required:type_documents, description',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên loại tài liệu',
            'description.required' => 'Chưa nhập mô tả loại tài liệu',
            'name.unique' => 'Tên Loại Tài Liệu Này Đã Tồn Tại',
        ];
    }
}
