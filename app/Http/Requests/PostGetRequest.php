<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostGetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => 'sometimes|numeric',
            'limit' => 'sometimes|numeric',
            'sort' => 'sometimes|in:id,topic,created_at,updated_at,',
            'direction' => 'sometimes|in:asc,desc',
            'with' => 'sometimes|in:comments',
            'id' => 'sometimes|exists:posts,id',
            'topic' => 'sometimes|string',
            'created_at' => 'sometimes|date',
            'updated_at' => 'sometimes|date',
            'comment'    => 'sometimes|string'
        ];
    }
}
