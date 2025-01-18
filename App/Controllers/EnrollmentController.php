<?php

class EnrollmentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function enroll()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            Session::redirectErr('/catalog', 'Invalid CSRF token.');
            return;
        }

        $course_id = isset($_GET['id']) ? intval($_GET['id']) : null;
        $user_id = Session::getId();

        if (!$course_id || $user_id === 0 || Session::getRole() !== 'student') {
            Session::redirectErr('/catalog', 'Invalid course/session.');
            return;
        }

        $enroll = new Enrollment($course_id, $user_id);

        if ($enroll->enroll()) {
            Session::redirectSuccess('/catalog', 'Enrolled!');
        } else {
            Session::redirectErr('/catalog', 'Failed to enroll, Try again later.');
        }
    }

    public function getAll()
    {
        $page = intval($_GET['p'] ?? 1);

        $user_id = Session::getId();
        if ($user_id === 0 || Session::getRole() !== 'student') {
            Session::redirectErr('/mycourses', 'Invalid session.');
            return;
        }

        $enroll = new Enrollment(0, $user_id);
        $result = $enroll->getEnrolledCourses($page);

        return [
            'courses' => $result['courses'],
            'pagination' => $result['pagination']
        ];
    }

    public function getCourseStudents()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        if (!$id) {
            Session::redirectErr('/mystats', 'Invalid ID.');
            return;
        }

        $enroll = new Enrollment($id, 0);
        return $enroll->getCourseStudents();
    }
}