<?php
namespace App\Services\User;

use App\Models\Database\DB;
use App\Services\User\UserServiceInterface;
use Exception;

class UserService implements UserServiceInterface{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function isUser(string $email): bool
    {
        $query = "SELECT id FROM genealogy_users WHERE email = :email LIMIT 1";
        $result = $this->db->fetchSingleData($query, [':email' => $email]);

        return $result !== null;
    }

    public function getTopPerformers(int $limit): array
    {
        throw new \Exception('Not implemented');
    }

    public function getUserById(int $id): ?object
    {
        throw new \Exception('Not implemented');
    }

    public function updateProfile(int $userId, array $data): bool
    {
        throw new \Exception('Not implemented');
    }
}