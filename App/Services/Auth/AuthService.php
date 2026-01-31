<?php
namespace App\Services\Auth;

use App\Services\Auth\AuthServiceInterface;
use App\Models\Database\DB;
use Exception;

class AuthService implements AuthServiceInterface {
    private $db;

    public function __construct() {
        $this->db = new DB(); //establish db connection
    }

    // REGISTER
    public function register(array $data, ?string $referralCode): bool {
        if (empty($data['username'])) {
                throw new Exception("Username is required.");
            }
        if (empty($data['email'])) {
            throw new Exception("Email address cannot be blank.");
        }

        try {
            $this->db->beginTransaction();

            //Create the user
            $query = "INSERT INTO genealogy_users (username, email, referral_code) VALUES (:u, :e, :r)";
            $params = [
                ':u' => $data['username'],
                ':e' => $data['email'],
                ':r' => $referralCode
            ];

            $success = $this->db->execute($query, $params);

            if (!$success) {
                throw new Exception("Database insertion failed.");
            }

            //Commit
            $this->db->commit();
            return true;

        } catch (Exception $error) {
            $this->db->rollBack();
            error_log("Registration Error: " . $error->getMessage());
            return false;
        }
    }

    // LOGIN
    public function login(string $email, string $password): bool
    {
        // IMPORTANT NOTE, $password does nothing
        if(empty($email) || empty($password)){
            return false;
        }
        try{
            $this->db->beginTransaction();
            $query = "SELECT * FROM genealogy_users WHERE email=:e";
            $params = [':e' => $email]; 
            $result = $this->db->fetchSingleData($query, $params);

            if(!$result){
                throw new Exception("User does not exists.");
            }

            // commit
            $this->db->commit();
            return true; 
        }catch(Exception $error){
            $this->db->rollBack();
            error_log("Login Error: " . $error->getMessage());
            return false;
        }
    }

    // LOGOUT
    public function logout(): void
    {
        throw new \Exception('Not implemented yet');
    }
}