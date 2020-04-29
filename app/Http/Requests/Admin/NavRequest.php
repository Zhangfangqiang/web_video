<?php

namespace App\Http\Requests\Admin;

use app\Models\Nav;

class NavRequest extends BaseRequest
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
                return [
                    'name'    => ['required', 'max:255', 'unique:navs,name'],
                    'remark'  => ['required', 'max:255'],
                    'is_main' => ['required', 'in:0,1', function ($attribute, $value, $fail) {
                        $nav = Nav::where('nav', 1)->first();
                        if (count($nav) > 0 && $value == 1) {
                            $fail('不能有两个重复的主导航');
                        }
                    }],
                ];
            case'PUT':
            case'PATCH':
                return [
                    'name' => ['required', 'max:255', 'unique:navs,name' . $this->route('nav')->id],
                    'remark' => ['required', 'max:255'],
                    'is_main' => ['required', 'in:0,1', function ($attribute, $value, $fail) {
                        $nav = Nav::where('nav', 1)->first();
                        if (count($nav) > 0 && $value == 1 && $this->route('nav')->id == $nav->id) {
                            $fail('不能有两个重复的主导航');
                        }
                    }],
                ];
        }
    }
}
