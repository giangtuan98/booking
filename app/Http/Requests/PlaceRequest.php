<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PlaceRequest extends FormRequest
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
            'place_id' => 'required|integer',
            'place_name' => 'required|unique:place,place_name'
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
            'place_id.required' => 'Bạn chưa nhập mã điểm',
            'place_id.integer' => 'Mã điểm phải là số',
            'place_name.required' => 'Bạn chưa nhập tên điểm',
            'place_name.unique' => 'Tên điểm đã tồn tại'
        ];
    }
}
