<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersEditRequest extends Request
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
            //Create request to prevent empty form from being submitted
            'name'=>'required|min:2',
            // 'lastname'=>'required|min:2',
            'email'=>'required|min:5',
            'status'=>'required',
            'role_id'=>'required'

        ];
    }
}
