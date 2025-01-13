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
            }

            $user = $this->userModel;

            $user->setEmail($email);

            if ($user->getByEmail()){
                $_SESSION['error'] = 'A user with this email already exists.';
                $this->redirect('/signup');
            }

            $user->setPassword($password);
            $user->setName($name);
            $user->setRole($role);

            if ($user->create()){
                $_SESSION['success'] = 'Registration successful.';
                $this->redirect('/login');
            } else {
                $_SESSION['error'] = 'Registration unsuccessful, Try again.';
                $this->redirect('/signup'); 
            }
        }

        echo 'dffd';
    }
}
