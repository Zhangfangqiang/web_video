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
                return $this->METHODGET;
            case 'POST':
                return [
                    'name'        => ['string' , 'required', 'max:255'],
                    'status'      => ['numeric', 'required', 'in:0,1'],
                    'list_order'  => ['numeric', 'required', 'max:9999'],
                    'target'      => ['string' , 'required', 'in:_self,_blank'],
                    'nav_id'      => ['numeric', 'required', 'exists:navs,id'],
                    'parent_id'   => ['numeric', 'nullable', 'exists:nav_menus,id'],
                    'c_id'        => ['numeric', 'nullable', 'exists:categories,id'],
                ];
            case'PUT':
            case'PATCH':
                return [
                    'name'        => ['string' , 'required', 'max:255'],
                    'status'      => ['numeric', 'required', 'in:0,1'],
                    'list_order'  => ['numeric', 'required', 'max:9999'],
                    'target'      => ['string' , 'required', 'in:_self,_blank'],
                    'nav_id'      => ['numeric', 'required', 'exists:navs,id'],
                    'parent_id'   => ['numeric', 'nullable', 'exists:nav_menus,id',
                    'c_id'        => ['numeric', 'nullable', 'exists:categories,id'],
                        function ($attribute, $value, $fail) {
                            if ($this->route('nav_menu')->id == $value) {
                                $fail('自身不能做自身的父类');
                            }
                        }
                    ],
                ];
        }
    }
}
