<?php

namespace App\Http\Requests\Api\Admin;

class UserApiRequest extends BaseRequest
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
                return [
                    'permission'   => ['nullable', 'array'],
                    'permission.*' => ['required', 'string', 'exists:permissions,name'],
                    'roles'        => ['nullable', 'array'],
                    'roles.*'      => ['required', 'string', 'exists:roles,name'],
                ];
        }
    }
}
