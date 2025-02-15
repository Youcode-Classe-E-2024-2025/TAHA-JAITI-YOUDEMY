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

    public static function getPopularCourse(): array
    {
        $pdo = Database::getInstance();

        $sql = "SELECT c.id, c.title, COUNT(e.student_id) as total_students FROM courses c
                JOIN enrollments e ON e.course_id = c.id
                GROUP BY c.id
                ORDER BY total_students ASC
                LIMIT 1";
        $result = $pdo->fetch($sql);

        if (!$result) {
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

    public static function getPopularTeachers(): array
    {
        $pdo = Database::getInstance();

        $sql = "SELECT u.id, u.name, COUNT(e.student_id) as students, COUNT(DISTINCT c.id) as courses 
            FROM users u
            JOIN courses c ON u.id = c.teacher_id
            LEFT JOIN enrollments e ON c.id = e.course_id
            WHERE u.role = 'teacher'
            GROUP BY u.id
            ORDER BY students DESC
            LIMIT 3";

        $result = $pdo->fetchAll($sql);

        if (!$result) {
            return [];
        }

        $usersArray = [];
        $statsArray = [];

        foreach ($result as $row) {
            $user = new User();
            $user->setId($row['id']);
            $user->setName($row['name']);

            $usersArray[] = $user;

            $statsArray[] = [
                'students' => $row['students'],
                'courses' => $row['courses']
            ];
        }

        return [
            'users' => $usersArray,
            'stats' => $statsArray
        ];
    }

    public static function getCourseByCategory(): array
    {
        $pdo = Database::getInstance();

        $sql = "SELECT cat.id, cat.name, COUNT(c.id) as course_count FROM categories cat
                LEFT JOIN courses c ON cat.id = c.category_id
                GROUP BY cat.id
                ORDER BY course_count ASC";
        $result = $pdo->fetchAll($sql);

        return $result ?? [];
    }
}
