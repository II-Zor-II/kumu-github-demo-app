<?php


namespace App\Repositories\ExternalApi;


use App\Repositories\Contracts\GithubApiInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ExternalGithubRepository implements GithubApiInterface
{

    private const API_URL = "https://api.github.com";

    private const RESOURCE_ROUTES = [
        "users" => "/users"
    ];

    private const REQUIRED_HEADERS = [
        'Accept' => 'application/vnd.github.v3+json'
    ];

    /**
     * @param string $username
     * @return array|null
     */
    public function findByUsername(string $username): ?array
    {
        Log::withContext([
            'class_function' => __CLASS__ . '_' . __FUNCTION__,
            'params' => [
                'username' => $username
            ]
        ]);

        $response = $this->getFromApi(self::RESOURCE_ROUTES['users'] . "/{$username}");

        if ($response->status() === 200 &&
            $response->ok() === true) {

            $apiResponse = $response->collect()->only([
                'login',
                'name',
                'company',
                'followers',
                'public_repos'
            ])->toArray();

            $apiResponse['avg_followers_per_repo'] = floor($apiResponse['followers'] / $apiResponse['public_repos']);

            return $apiResponse;
        }

        return null;
    }

    /**
     * @param array $users
     * @return array
     */
    public function findUsers(array $users): array
    {
        $response = [];

        foreach($users as $username) {
            $response[$username] = $this->findUsers($username);
        }

        return $response;
    }

    /**
     * @param string $resourceUrl
     * @return Response
     */
    private function getFromApi(string $resourceUrl)
    {
        $response = Http::withHeaders(self::REQUIRED_HEADERS)->get(self::API_URL . $resourceUrl);

        return $response;
    }

}
