<?php

namespace App\Http\Requests\Web;

use App\Models\Category;

class CategoriesRequest extends BaseRequest
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
                    'ids' => ['nullable', 'string',
                        function ($attribute, $value, $fail) {
                            $ids   = explode(',', $value);
                            $count = Category::whereIn('id',$ids)->count();

                            if (count($ids) != $count) {
                                $fail('你搞事情??');
                            }
                        }
                    ],
                ];
            case 'POST':
                return [];
            case'PUT':
            case'PATCH':
                return [];
        }
    }
}
