<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
            'route_id' => 'required|integer',
            'route_name' => 'required',
            'price' => 'required|digits_between:1,999999999',
            'departure' => 'required|different:destination',
            'destination' => 'required',
            'duration' => 'required',
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
            'route_id.required' => 'Bạn chưa nhập mã tuyến',
            'route_id.integer' => 'Mã tuyến phải là số',
            'route_name.required' => 'Bạn chưa nhập tên tuyến',
            'price.required' => 'Bạn chưa nhập giá',
            'price.integer' => 'Giá phải là số nguyên',
            'price.digits_between' => 'Giá phải lớn hơn 1',
            'departure.required' => 'Bạn chưa chọn điểm đi',
            'departure.different' => 'Điểm đi và điểm đến phải khác nhau',
            'destination.required' => 'Bạn chưa chọn điểm đến',
            'duration.required' => 'Bạn chưa nhập giá',
        ];
    }
}
