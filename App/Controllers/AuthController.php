<?php

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateToken($_POST['csrf'])) {
                Session::redirectErr('/signup');
            }

            $data = $this->getData();

            $name = $data['username'];
            $email = $data['email'];
            $password = $data['password'];
            $role = $data['role'];

            if (empty($name) || empty($email) || empty($password) || empty($role)) {
                Session::redirectErr('/signup', 'All fields are required');
            }

            $user = new User();

            $user->setEmail($email);

            if ($user->getByEmail()) {
                Session::redirectErr('/signup', 'A user with this email already exists');
            }

            $user->setPassword($password);
            $user->setName($name);
            $user->setRole($role);

            if ($user->create()) {
                Session::redirectSuccess('/login', "Registration successful");
            } else {
                Session::redirectErr('/signup');
            }
        }
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateToken($_POST['csrf'])) {
                Session::redirectErr('/login');
            }

            $data = $this->getData();

            $email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $data['password'] ?? '';

            if (empty($email) || empty($password)) {
                Session::redirectErr('/login', 'All fields are required.');
                return;
            }
        
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Session::redirectErr('/login', 'Invalid email format.');
                return;
            }

            $user = new User();
            $user->setEmail($email);

            $userData = $user->getByEmail();

            if (!$userData || empty($userData)) {
                Session::redirectErr('/login', 'A user with this email does not exist');
                return;
            }

            if (!password_verify($password, $userData['password'])) {
                Session::redirectErr('/login', 'Invalid password');
                return;
            }

            if ($userData['status'] !== 'active') {
                Session::redirectErr('/login', 'Your account is pending approval/suspended.');
                return;
            }

            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id' => $userData['id'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role' => $userData['role']
            ];

            switch ($userData['role']) {
                case 'admin':
                    Session::redirect('/statistics');
                    break;
                case 'teacher':
                    Session::redirect('/home');
                    break;
                case 'student':
                    Session::redirect('/home');
                    break;
                default:
                    Session::redirectErr();
                    session_destroy();
            }
        }
    }

    public function logout(): void
    {
        session_destroy();
        Session::redirect('/login');
    }
}
