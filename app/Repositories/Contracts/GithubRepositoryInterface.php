<?php


namespace App\Repositories\Contracts;


interface GithubRepositoryInterface
{
    public function findByUsername(string $username): ?array;

    public function findUsers(array $users): array;
}
