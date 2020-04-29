<?php

namespace App\Http\Requests\Api\Admin;

use App\Models\Category;

class ContentApiRequest extends BaseRequest
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
                    'title'     =>['required' , 'string' , 'max:255'],
                    'c_id'      =>['required' , 'string' , 'max:255',  function ($attribute, $value, $fail) {
                        $c_id  = array_unique(explode(',', $value));
                        $count = Category::whereIn('id',$c_id)->count();

                        if (count($c_id) != $count) {
                            $fail('你搞事情??');
                        }
                    }],
                    'content'  =>['nullable' , 'string' , 'max:20000']
                ];
            case'PUT':
            case'PATCH':
                return [
                    'title'     =>['required' , 'string' , 'max:255'],
                    'c_id'      =>['required' , 'string' , 'max:255',  function ($attribute, $value, $fail) {
                        $c_id  = array_unique(explode(',', $value));
                        $count = Category::whereIn('id',$c_id)->count();

                        if (count($c_id) != $count) {
                            $fail('你搞事情??');
                        }
                    }],
                    'content'  =>['nullable' , 'string' , 'max:20000']
                ];
        }
    }
}
