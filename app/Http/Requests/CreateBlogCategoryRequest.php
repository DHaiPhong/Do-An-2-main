<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogCategoryRequest extends FormRequest
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
            'title' => 'required|unique:category_blogs, title',
            'description' => 'required|unique:category_blogs, description',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title cannot be blank ',
            'description.required' => 'Description cannot be blank ',
        ];
    }
}
