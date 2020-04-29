<?php

namespace App\Http\Requests\Admin;

class LinkRequest extends BaseRequest
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
                    'title'       => ['required', 'string'],
                    'description' => ['required', 'string'],
                    'link'        => ['required', 'string']
                ];
            case'PUT':
            case'PATCH':
                return [
                    'title'       => ['required', 'string'],
                    'description' => ['required', 'string'],
                    'link'        => ['required', 'string']
                ];
        }
    }
}
