<?php

namespace App\Http\Requests\Web;

class CommentRequest extends BaseRequest
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
                    'content'          => ['required', 'string' , 'max:1000'],
                    'captcha'          => ['required', 'captcha', 'max:255'],
                    'commentable_type' => ['required', 'string' , 'max:255', 'in:App\Models\Content'],
                    'commentable_id'   => ['required', 'numeric', function ($attribute, $value, $fail) {
                        $model = new $this->commentable_type;
                        if(is_null($model->find($value))){
                            return false;
                        }
                    }],
                    'parent_id'        => ['nullable','numeric','exists:comments,id']
                ];
            case'PUT':
            case'PATCH':
                return [];
        }
    }

    /**
     * 定义提示消息
     * @return array
     */
    public function messages()
    {
        return [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha'  => '请输入正确的验证码',
        ];
    }
}
