<?php
namespace App\Services\Referral;

interface ReferralServiceInterface{
    public function generateUniqueCode(int $userId): string;
    public function validateCode(string $code): ?int;
}