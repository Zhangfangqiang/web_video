<?php

namespace App\Http\Requests\Web;

class UserRequest extends BaseRequest
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

                ];
            case'PUT':
            case'PATCH':
                return [
                    'name'         => ['required', 'string', 'between:2,25', 'max:255', 'unique:users,name,'. $this->route('user')->id ],
                    'email'        => ['required', 'string', 'email'  , 'max:255', 'unique:users,email,'. $this->route('user')->id ],
                    'introduction' => ['nullable', 'string', 'max:255'],
                    'avatar'       => ['image'   , 'dimensions:min_width=500,min_height=500'],
                ];
        }
    }

    /**
     * 定义提示消息
     * @return array
     */
    public function messages()
    {
        return [
            'avatar.mimes'      =>'头像必须是 jpeg, bmp, png, gif 格式的图片',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 208px 以上',
        ];
    }

    /**
     * 定义消息字段
     * @return array
     */
    public function attributes()
    {
        return [
            'name'         => '用户名',
            'email'        => '邮箱',
            'introduction' => '个人简介',
            'avatar'       => '头像',
        ];
    }
}
