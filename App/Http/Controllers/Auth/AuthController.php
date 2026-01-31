<?php
namespace App\Http\Controllers\Auth;

use App\Services\Auth\AuthService;
use App\Core\BaseController;
use Exception;

class AuthController extends BaseController{
    private $auth_service;

    public function __construct()
    {
        $this->auth_service = new AuthService();
    }

    public function showLoginPage(){
        $this->renderView('Auth/login');
    }

    public function showRegisterPage(){
        $this->renderView('Auth/register');
    }


    public function register(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->renderView('Auth/register');
                return;
        }

        try {
            //code...
        } catch (\Exception $error) {
            $this->renderView(
                "Auth/register",
                [
                    "errorMessage" => $error->getMessage(),
                    "oldInput" => $_POST
                ]
            );
        }
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->renderView('Auth/login');
                return;
        }

        try {
                $success = $this->auth_service->login($_POST['email'] ?? '', $_POST['password'] ?? '');
                
                if($success === true){
                    $_SESSION['is_logged_in'] = true;
                    header("Location: /genealogy-dashboard?success=1");
                    exit; 
                }else{
                    $this->renderView('Auth/login', [
                    'errorMessage' => "User does not exists",
                    'oldInput' => $_POST
                ]);
                }

            } catch (Exception $e) {
                // use renderView to keep data and show the error
                $this->renderView('Auth/register', [
                    'errorMessage' => $e->getMessage(),
                    'oldInput' => $_POST
                ]);
            }
    }
}