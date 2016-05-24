<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AttendeeRequest extends Request
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
                'attendee_title' => 'required|unique:tbl_attendee_types,attendee_title',
            ];
    }

    public function response(array $errors) {
        return response()->json([
                    'STATUS'=> 'INVALID INPUT',
                    'MESSAGE'=>'ERROR FOUND(s)',
                    'CODE' => 400,
                    'ERROR' => $errors
                ], 200);
    }
}
