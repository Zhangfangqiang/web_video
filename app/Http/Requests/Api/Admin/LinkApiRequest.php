<?php

namespace App\Http\Requests\Api\Admin;

class LinkApiRequest extends BaseRequest
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
                    'title'       => ['required','string','max:700','unique:links,title'],
                    'description' => ['required','string','max:1000'],
                    'link'        => ['required','string','max:700','unique:links,link']
                ];
            case'PUT':
            case'PATCH':
                return [
                    'title'       => ['required','string','max:700','unique:links,title,'. $this->route('link')->id],
                    'description' => ['required','string','max:1000'],
                    'link'        => ['required','string','max:700','unique:links,link,'. $this->route('link')->id]
                ];
        }
    }
}
