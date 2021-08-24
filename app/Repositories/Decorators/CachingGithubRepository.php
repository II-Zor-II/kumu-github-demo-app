<?php


namespace App\Repositories\Decorators;

use App\Repositories\Contracts\GithubApiInterface;
use App\Repositories\Contracts\GithubRepositoryInterface;
use Illuminate\Cache\Repository as Cache;


class CachingGithubRepository implements GithubRepositoryInterface
{
    /**
     * @var Cache $cache
     */
    protected Cache $cache;

    /**
     * @var GithubApiInterface
     */
    protected GithubApiInterface $externalApi;

    public function __construct(Cache $cache, GithubApiInterface $externalApi)
    {
        $this->cache = $cache;
        $this->externalApi = $externalApi;
    }

    /**
     * @param string $username
     * @return array|null
     */
    public function findByUsername(string $username): ?array
    {
        $cache = $this->cache->tags('github')->get($username);

        if (is_null($cache)) {
            $cache = $this->cache->tags('github')->remember($username, 500, function () use ($username) {
                return $this->externalApi->findByUsername($username);
            });
        }

        return $cache;
    }

    /**
     * @param array $users
     * @return array
     */
    public function findUsers(array $users): array
    {
        $response = [];

        foreach ($users as $username) {
            $response[$username] = $this->findByUsername($username);
        }

       return $response;
    }
}
