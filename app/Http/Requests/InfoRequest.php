<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
            'customername' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'customername.required' => 'Xin mời nhập tên',
            'email.required' => 'Xin mời nhập email',
            'email.email' => 'Email không đúng dạng',
            'phone.required' => 'Xin mời nhập số điện thoại',
            'address.required' => 'Xin mời nhập địa chỉ'
        ];
    }
}
