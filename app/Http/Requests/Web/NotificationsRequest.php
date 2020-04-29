<?php

namespace App\Http\Requests\Web;

class NotificationsRequest extends BaseRequest
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
                    'type' => ['required','string','in:App\Notifications\CommentReplyNotification,App\Notifications\ContentCommentsNotification']
                ];
            case 'POST':
                return [];
            case'PUT':
            case'PATCH':
                return [];
        }
    }
}
