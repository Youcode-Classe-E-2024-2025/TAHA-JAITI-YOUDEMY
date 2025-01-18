<?php

class AdminStats extends Enrollment
{

    public function __construct()
    {
        parent::__construct(0, 0);
    }

    public function getTotalCourses(): int
    {
        $sql = "SELECT COUNT(*) as total_courses FROM courses";
        $result = $this->pdo->fetch($sql);
        return (int) $result['total_courses'];
    }

    public function getPopularCourse(): array {
        $sql = "SELECT c.id, c.title, COUNT(e.student_id) as total_students FROM courses c
                JOIN enrollments e ON e.course_id = c.id
                GROUP BY c.id
                ORDER BY total_students ASC
                LIMIT 1";
        $result = $this->pdo->fetch($sql);

        if (!$result){
            return [];
        }
        
        $course = new AdminCourse();
        $course->setId($result['id']);
        $course->setTitle($result['title']);
        
        return [
            'course' => $course,
            'count' => $result['total_students']
        ];
    }
}
