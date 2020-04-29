<?php

namespace App\Http\Requests\Admin;

class OperationgLogRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [];
            case 'POST':
                return [];
            case'PUT':
            case'PATCH':
                return [];
        }
    }
}
