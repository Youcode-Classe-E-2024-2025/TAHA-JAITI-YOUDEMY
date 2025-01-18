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
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-users');
        }

        $id = intval($_GET['id']);

        $user = $this->userModel;

        $user->setId($id);
        $user->setStatus('active');

        if ($user->updateStatus()) {
            $_SESSION['success'] = 'User approved.';
            $this->redirect('/manage-users');
        } else {
            $_SESSION['error'] = 'Failed to approve user.';
            $this->redirect('/manage-users');
        }
    }

    public function suspend(){
        if (!$this->validateToken($_GET['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-users');
        }

        $id = intval($_GET['id']);

        $user = $this->userModel;

        $user->setId($id);
        $user->setStatus('suspended');

        if ($user->updateStatus()) {
            $_SESSION['success'] = 'User suspended.';
            $this->redirect('/manage-users');
        } else {
            $_SESSION['error'] = 'Failed to suspend user.';
            $this->redirect('/manage-users');
        }
    }

    public function delete(){
        if (!$this->validateToken($_GET['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-users');
        }

        $id = intval($_GET['id']);

        $user = $this->userModel;

        $user->setId($id);

        if ($user->delete()) {
            $_SESSION['success'] = 'User deleted.';
            $this->redirect('/manage-users');
        } else {
            $_SESSION['error'] = 'Failed to delete user.';
            $this->redirect('/manage-users');
        }
    }
}
