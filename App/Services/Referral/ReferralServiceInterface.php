<?php
namespace App\Services\Referral;

interface ReferralServiceInterface{
    public function generateUniqueCode(): string;
    public function validateCode(string $code): ?bool;
}