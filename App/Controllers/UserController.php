<?php

class UserController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function getAll()
    {
        $users = $this->userModel->getAll();
        return $users;
    }

    public function getAllTeachers()
    {
        $users = $this->userModel->getAllTeachers();
        return $users;
    }

    public function approve()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            Session::redirectErr('/manage-users', 'Invalid CSRF token.');
            return;
        }

        $id = intval($_GET['id']);

        $user = $this->userModel;
        $user->setId($id);
        $user->setStatus('active');

        if ($user->updateStatus()) {
            Session::redirectSuccess('/manage-users', 'User approved.');
        } else {
            Session::redirectErr('/manage-users', 'Failed to approve user.');
        }
    }

    public function suspend()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            Session::redirectErr('/manage-users', 'Invalid CSRF token.');
            return;
        }

        $id = intval($_GET['id']);

        $user = $this->userModel;
        $user->setId($id);
        $user->setStatus('suspended');

        if ($user->updateStatus()) {
            Session::redirectSuccess('/manage-users', 'User suspended.');
        } else {
            Session::redirectErr('/manage-users', 'Failed to suspend user.');
        }
    }

    public function delete()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            Session::redirectErr('/manage-users', 'Invalid CSRF token.');
            return;
        }

        $id = intval($_GET['id']);

        $user = $this->userModel;
        $user->setId($id);

        if ($user->delete()) {
            Session::redirectSuccess('/manage-users', 'User deleted.');
        } else {
            Session::redirectErr('/manage-users', 'Failed to delete user.');
        }
    }
}