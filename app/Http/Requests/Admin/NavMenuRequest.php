<?php

namespace App\Http\Requests\Admin;

class NavMenuRequest extends BaseRequest
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
                return [
                    'nav_id' => ['required','exists:navs,id']
                ];
            case 'POST':
                return [];
            case'PUT':
            case'PATCH':
                return [];
        }
    }
}
