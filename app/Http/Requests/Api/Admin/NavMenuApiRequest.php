<?php

namespace App\Http\Requests\Api\Admin;

class NavMenuApiRequest extends BaseRequest
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
