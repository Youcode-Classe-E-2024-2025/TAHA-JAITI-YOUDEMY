<?php

class CourseController extends Controller {

    private Course $course;

    public function __construct(){
        $this->course = new Course();
    }

    public function getAll(){
        $courses = $this->course->getAll();
        return $courses;
    }

}