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
            if (!$this->validateToken($_POST['csrf'])){
                $_SESSION['error'] = 'Invalid CSRF token.';
                $this->redirect('/signup');
            }

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
                $_SESSION['success'] = 'Registration successful, Please wait until an admin accepts you.';
                $this->redirect('/login');
            } else {
                $_SESSION['error'] = 'Registration unsuccessful, Try again.';
                $this->redirect('/signup'); 
            }
        }
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateToken($_POST['csrf'])) {
                $_SESSION['error'] = 'Invalid CSRF token.';
                $this->redirect('/login');
            }

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'All fields are required.';
                $this->redirect('/login');
            }

            $user = $this->userModel;
            $user->setEmail($email);

            $userData = $user->getByEmail();

            if (!$userData) {
                $_SESSION['error'] = 'A user with this email does not exist.';
                $this->redirect('/login');
            }

            if (!password_verify($password, $userData['password'])) {
                $_SESSION['error'] = 'Invalid password.';
                $this->redirect('/login');
            }

            if ($userData['status'] !== 'active') {
                $_SESSION['error'] = 'Your account is pending approval/suspended.';
                $this->redirect('/login');
            }

            $_SESSION['user'] = [
                'id' => $userData['id'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role' => $userData['role']
            ];

            switch ($userData['role']) {
                case 'admin':
                    $this->redirect('/home');
                    break;
                case 'teacher':
                    $this->redirect('/home');
                    break;
                case 'student':
                    $this->redirect('/home');
                    break;
                default:
                    $_SESSION['error'] = 'Invalid role.';
                    $this->redirect('/login');
            }
        }
    }

}
