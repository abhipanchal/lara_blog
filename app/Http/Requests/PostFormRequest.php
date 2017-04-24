<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostFormRequest extends Request
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
            'post_title' => 'required | min:5 ',
            'post_data' => 'required | min:20',
            'post_date' => 'required',
            'post_image'=>'mimes:jpeg,png',
        ];

     }
}
