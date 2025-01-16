<?php

class StudentCourse extends Course{

    public function __construct(){
        parent::__construct();
    }

    public function save(): bool{
        throw new Exception('You dont have the permission');
    }

    public function getById(): Course|null{
        return null;
    }

    public function getAll(): array{
        return [];
    }

}