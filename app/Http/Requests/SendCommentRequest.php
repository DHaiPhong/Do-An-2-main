<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendCommentRequest extends FormRequest
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
            'content' => 'required|max=255|min=8'
        ];
    }
    public function messages()
    {
        return [
            'content.required' => 'Bạn chưa nhập bình luận!',
            'content.max' => 'Không được vượt quá 255 kí tự',
            'content.min' => 'Không được ít hơn 8 kí tự',
        ];
    }
}
