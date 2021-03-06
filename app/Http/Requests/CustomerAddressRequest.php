<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerAddressRequest extends Request
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
          'address_line_1' => 'required|min:5',
          'city' => 'required',
          'postcode' => 'required',
          'phone_number' => 'required'
        ];
    }
}
