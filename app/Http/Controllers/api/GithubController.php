<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\api\Github\GithubRequest;
use App\Repositories\Contracts\GithubRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GithubController extends BaseController
{
    /**
     * @var GithubRepositoryInterface $repository
     */
    protected GithubRepositoryInterface $repository;

    public function __construct(GithubRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function test(Request $request)
    {
        return response()->json(['test' => Str::random(16)]);
    }

    function getUsers(GithubRequest $request)
    {
        $users = $request->get('users');

        $response = $this->repository->findUsers($users);

        return $response;
    }


}
