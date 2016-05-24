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
        date_default_timezone_set ( 'Asia/Phnom_Penh' );
        $create_date = date ( "Y-m-d H:i:s" );
        return [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'job_id_for' =>'required',
                'attendee_id_for' =>'required',
                'extra_guest' => 'required',
                'dinner' => 'required',
                'paper' => 'required',
                'created_at'=> $create_date,
                'updated_at'=> $create_date
            ];
    }

    public function response(array $errors) {
        return response()->json([
                    'STATUS'=> 'INVALID INPUT',
                    'MESSAGE'=>'ERROR FOUNDS',
                    'CODE' => 400,
                    'ERROR' => $errors
                ], 200);
    }
}
