<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            
                'name' => 'required',
                'email' => 'required',
                'city' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'district' => 'required',
            
        ];
    }
    public function messages()
    {
        return [
            'city.required' => 'Chưa chọn Thành Phố',
            'district.required' => 'Chưa chọn Quận Huyện',
        ];
    }
}
