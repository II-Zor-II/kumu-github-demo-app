<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\api\Users\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    /**
     * @var Model $model
     */
    protected Model $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    function test(Request $request)
    {
        return response()->json(['test' => Str::random(16)]);
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    function store(UserRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $star = '';

        for ($i = 0; $i < strlen($password); $i++) {
            $star .= '*';
        }

        $response['user'] = [
            'username' => $username,
            'password' => $star
        ];

        $http_code = 201;

        try {
            $this->model->username = $username;

            $this->model->password = Hash::make($password);

            if ($this->model->save()) {
                $token = $this->model->createToken('github');
                $response['access_token'] = $token->plainTextToken;
                $response['message'] = 'User successfully registered. Please save your access token.';
            }

        } catch (\Exception $e) {

            $error_message = 'User registration failed. User already exists.';

            Log::error($error_message, [
                'class_function' => __CLASS__ . '_' . __FUNCTION__,
                'exception_message' => $e->getMessage(),
                'request_params' => $request->all()
            ]);

            $response['message'] = $error_message;
            $http_code = 409;

        }

        return response()->json($response, $http_code);
    }


}
