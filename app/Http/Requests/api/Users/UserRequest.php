<?php


namespace App\Http\Requests\api\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRequest
 * @package App\Http\Requests\api\Users
 */
class UserRequest extends FormRequest
{
    /**
     * contains only basic validation for the request
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }
}
