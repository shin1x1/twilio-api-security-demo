<?php

namespace App\Http\Requests;

class CallingRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
