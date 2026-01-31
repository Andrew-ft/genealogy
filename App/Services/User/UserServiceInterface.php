<?php
namespace App\Services\User;

interface UserServiceInterface{
    public function isUser(string $email):bool;
    public function getUserById(int $id): ?object;
    public function updateProfile(int $userId, array $data): bool;
    public function getTopPerformers(int $limit): array; //for hall of fame/league logic
}