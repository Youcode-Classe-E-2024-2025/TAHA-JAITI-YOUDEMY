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

    public function getPopularCourse(){
        
    }
}
