<?php

namespace App\Http\Requests\Admin;


class UeditorRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'action'   => ['nullable', 'string', 'max:255'],
            'size'     => ['nullable', 'numeric'],
            'start'    => ['nullable', 'numeric'],
            'callback' => ['nullable', 'string', 'max:255'],
        ];
    }
}
