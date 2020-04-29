<?php

namespace App\Http\Requests\Api\Admin;

class CategoryHasContentApiRequest extends BaseRequest
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
                return $this->METHODGET;
            case 'POST':
                return [];
            case'PUT':
            case'PATCH':
                return [];
        }
    }
}
