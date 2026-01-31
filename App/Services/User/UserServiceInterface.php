<?php
namespace App\Service\User;

interface UserServiceInterface{
    public function getUserById(int $id): ?object;
    public function updateProfile(int $userId, array $data): bool;
    public function getTopPerformers(int $limit): array; //for hall of fame/league logic
}