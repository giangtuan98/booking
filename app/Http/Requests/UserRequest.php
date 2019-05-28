<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'inputEmail'=>'required|email',
            'inputUserName'=>'required',
            'inputUserPassword'=>'required|min:6|max:20',
            'inputUserConfirmPassword'=>'required|same:inputUserPassword',
            'selectRoleId'=>'required'
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
            'inputEmail.required'=>'Vui lòng nhập email',
            'inputEmail.email'=>'Không đúng định dạng email',
            'inputUserPassword.required'=>'Vui lòng nhập mật khẩu',
            'inputUserConfirmPassword.same'=>'Mật khẩu không giống nhau',
            'inputUserPassword.min'=>'Mật khẩu phải có độ dài ít nhất 6 ký tự',
            'selectRoleId.required'=>'Bạn chưa phân quyền'
        ];
    }
}
