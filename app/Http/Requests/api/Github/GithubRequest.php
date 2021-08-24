<?php

namespace App\Http\Requests\api\Github;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GithubRequest
 * @package App\Http\Requests\api\Github
 */
class GithubRequest extends FormRequest
{
    /**
     * contains only basic validation for the request
     * @return array
     */
    public function rules()
    {
        return [
            'users' => 'array|required|between:1,10',
            'users.*' => 'distinct:strict|filled'
        ];
    }
}
