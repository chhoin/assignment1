<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
                'name' => 'required|unique:tbl_users,name',
                'address' => 'required',
                'phone' => 'required|unique:tbl_users,phone',
                'email' => 'required|unique:tbl_users,email',
                'job_id_for' =>'required',
                'attendee_id_for' =>'required',
            ];
    }

    public function response(array $errors) {
        return response()->json([
                    'STATUS'=> false,
                    'MESSAGE'=>'ERROR FOUND(s)',
                    'CODE' => 400,
                    'ERROR' => $errors
                ], 200);
    }
}
