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

    public function create(){
        if (!$this->validateToken($_POST['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-courses');
        }

        $data = $this->getData();

        $title = $data['title'];
        $description = $data['description'];
        $content = $data['content'];
        $image = $data['image'];
        $teacher = $_SESSION['user']['role'] === 'teacher' ? $_SESSION['user']['id'] : 1;

    }

    public function delete(){
        if (!$this->validateToken($_GET['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-courses');
        }

        $id = intval($_GET['id']);

        if (empty($id)) {
            $_SESSION['error'] = 'Course ID is required.';
            $this->redirect('/manage-courses');
        }

        $this->course->setId($id);

        if ($this->course->delete()){
            $_SESSION['success'] = 'Course deleted successfully';
        } else {
            $_SESSION['error'] = 'Failed to delete course';
        }

        $this->redirect('/manage-courses');
    }

}