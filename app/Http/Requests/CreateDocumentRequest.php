<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class CreateDocumentRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ];

        $countFile = count(Input::file('content'))-1 ;


        foreach (range(0, $countFile) as $i) {
            $rules['content.'.$i] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Nhập Tên Tài Liệu',
            'description.required' => 'Nhập mô tả tài liệu',
            'status.required' => 'Chọn trạng thái tài liệu',
            'content.0.required' => 'Chưa chọn file',
        ];
    }
}
