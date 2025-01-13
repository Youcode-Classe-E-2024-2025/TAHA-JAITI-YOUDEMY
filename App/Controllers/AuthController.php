<?php

class AuthController extends Controller
{
    private User $userModel;

    public function __construct(){
        $this->userModel = new User();
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (empty($name) || empty($email) || empty($password) || empty($role)) {
                $_SESSION['error'] = 'All fields are required.';
                $this->redirect('/signup');
                exit;
            }
        }

        echo 'dffd';
    }
}
