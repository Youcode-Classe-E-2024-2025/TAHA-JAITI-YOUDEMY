<?php

class UserController {

    private User $userModel;

    public function __construct(){
        $this->userModel = new User();
    }

    public function getPending(){
        $users = $this->userModel->getPending();

        return $users;
    }

}