<?php

class EnrollmentController extends Controller {
    
    public function enroll(){
        if (!$this->validateToken($_GET['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/catalog');
        }

        $course_id = isset($_GET['id']) ? intval($_GET['id']) : null;
        $user_id = Session::getId();

        if (!$course_id || $user_id === 0 || Session::getRole() !== 'student'){
            $_SESSION['error'] = 'Invalid course/session.';
            $this->redirect('/catalog');
        }

        $enroll = new Enrollment($course_id, $user_id);

        if ($enroll->enroll()){
            $_SESSION['success'] = 'Enrolled!';
            $this->redirect('/catalog');
        } else {
            $_SESSION['error'] = 'Failed to enroll, Try again later.';
            $this->redirect('/catalog');
        }

    }
}