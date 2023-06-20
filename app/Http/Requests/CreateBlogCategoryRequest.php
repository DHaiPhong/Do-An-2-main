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
            'title' => 'required|max:255',
            'description' => 'required|',
            'slug' => 'required|unique:category_blogs,slug',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title cannot be blank ',
            'title.max' => 'Title cannot more than 255 ',
            'slug.required' => 'Slug cannot be blank ',
            'slug.unique' => 'Slug unique ',
            'description.required' => 'Description cannot be blank ',
        ];
    }
}
