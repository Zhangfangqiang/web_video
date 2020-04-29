<?php

namespace App\Http\Requests\Api\Admin;

class PermissionApiRequest extends BaseRequest
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
                return [
                    'name'       => ['required', 'string', 'max:255','unique:permissions,name'],
                    'alias'      => ['required', 'string', 'max:255','unique:permissions,alias'],
                    'guard_name' => ['required', 'string', 'max:255'],
                ];
            case'PUT':
            case'PATCH':
                return [
                    'name'       => ['required', 'string', 'max:255','unique:permissions,name,'. $this->route('permission')->id],
                    'alias'      => ['required', 'string', 'max:255','unique:permissions,alias,'. $this->route('permission')->id],
                    'guard_name' => ['required', 'string', 'max:255'],
                ];
        }
    }
}
