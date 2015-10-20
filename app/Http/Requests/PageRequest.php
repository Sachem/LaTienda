<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request
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
      $this->merge(['visible' => $this->input('visible', 0)]);
      $this->merge(['contact_form' => $this->input('contact_form', 0)]);
      
        return [
            'title' => 'required',
            'path' => 'required',
            'content' => 'required|min:5',
            //
        ];
    }
}
