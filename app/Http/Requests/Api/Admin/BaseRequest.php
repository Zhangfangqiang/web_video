<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * 公用get请求方法验证
     * @var array 
     */
    protected $METHODGET = [
        'page'         => ['nullable', 'numeric'],
        'paginate'     => ['nullable', 'numeric'],
        'limit'        => ['nullable', 'numeric'],
        'offset'       => ['nullable', 'numeric'],
        'search'       => ['nullable', 'string'],
        'with'         => ['nullable', 'array'],
        'order'        => ['nullable', 'array'],
        'otherWhere'   => ['nullable', 'array'],
        'whereNotNull' => ['nullable', 'array'],
        'otherWhereIn' => ['nullable', 'array'],
        'tree'         => ['nullable', 'boolean'],
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
