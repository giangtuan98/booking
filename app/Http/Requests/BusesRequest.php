<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusesRequest extends FormRequest
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
            'buses_id' => 'required|integer',
            'buses_name' => 'required',
            'depart_time' => 'required',
            'arrive_time' => 'required',
            'route_id' => 'required',
            'car_id' => 'required'
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
            'buses_id.required' => 'Bạn chưa nhập mã chuyến',
            'buses_id.integer' => 'Mã chuyến phải là số',
            'buses_name.required' => 'Bạn chưa nhập tên chuyến',
            'depart_time.required' => 'Bạn chưa nhập giờ đi',
            'arrive_time.required' => 'Bạn chưa nhập giờ đến',
            'route_id.required' => 'Bạn chưa chọn mã tuyến',
            'car_id.required' => 'Bạn chưa chọn mã xe'
        ];
    }
}
