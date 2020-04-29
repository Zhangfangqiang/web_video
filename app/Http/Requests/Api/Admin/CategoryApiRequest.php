<?php

namespace App\Http\Requests\Api\Admin;

class CategoryApiRequest extends BaseRequest
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
                    'name'         => ['string' , 'required' , 'max:255'],
                    'description'  => ['string' , 'required' , 'max:255'],
                    'parent_id'    => ['numeric', 'nullable' , 'exists:categories,id'],
                ];
            case'PUT':
            case'PATCH':
                return [
                    'name'         => ['string' , 'required' , 'max:255'],
                    'description'  => ['string' , 'required' , 'max:255'],
                    'parent_id'    => ['numeric', 'nullable', 'exists:categories,id',
                        function ($attribute, $value, $fail) {
                            if ($this->route('category')->id == $value) {
                                $fail('自身不能做自身的父类');
                            }
                        }
                    ],
                ];
        }
    }
}
