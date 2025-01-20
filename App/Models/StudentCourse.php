<?php

class StudentCourse extends Course
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save(): bool
    {
        throw new Exception('You dont have the permission');
    }

    public function getById(): Course|null
    {
        $sql = "SELECT * FROM courses WHERE id = :id";
        $data = $this->pdo->fetch($sql, ['id' => $this->id]);

        if (!$data) {
            return null;
        }

        $course = new self();
        $course->setId($data['id']);
        $course->setTitle($data['title']);
        $course->setDescription($data['description']);
        $course->setContent($data['content']);
        $course->setImage($data['image']);

        $teacher = new User();
        $teacher->setId($data['teacher_id']);
        $course->setTeacher($teacher);

        $category = new Category();
        $category->setId($data['category_id']);
        $course->setCategory($category);

        $courseTag = new CourseTag();
        $courseTag->setCourseId($data['id']);
        $tags = $courseTag->getTagsByCourse();
        $course->setTags($tags);

        return $course;
    }

    public function getAll(int $page = 1, int $limit = 8): array
    {

        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM courses LIMIT :limit OFFSET :offset";
        $data = $this->pdo->fetchAll($sql, [
            ':limit' => $limit,
            ':offset' => $offset,
        ]);

        $totalCount = 'SELECT COUNT(*) as total FROM courses';
        $totalRes = $this->pdo->fetch($totalCount);

        $pageCount = ceil($totalRes['total'] / $limit);

        $courses = [];
        foreach ($data as $row) {
            $course = new self();
            $course->setId($row['id']);
            $course->setTitle($row['title']);
            $course->setDescription($row['description']);
            $course->setContent($row['content']);
            $course->setImage($row['image']);

            $teacher = new User();
            $teacher->setId($row['teacher_id']);
            $course->setTeacher($teacher);

            $category = new Category();
            $category->setId($row['category_id']);
            $course->setCategory($category);

            $courseTag = new CourseTag();
            $courseTag->setCourseId($row['id']);
            $tags = $courseTag->getTagsByCourse();
            $course->setTags($tags);

            $courses[] = $course;
        }

        return [
            'courses' => $courses,
            'pagination' => [
                'page' => $page,
                'total_pages' => $pageCount
            ]
        ];
    }

    public function search(string $input): array
    {
        if (empty($input)) {
            return [];
        }

        $sql = "SELECT c.id, c.title, c.description, c.content, c.image, 
                u.id as teacher_id, u.name as teacher_name, 
                cat.id as category_id, cat.name as category_name
            FROM courses c
            JOIN users u ON c.teacher_id = u.id
            JOIN categories cat ON c.category_id = cat.id
            WHERE c.title LIKE :query 
            OR c.description LIKE :query 
            OR cat.name LIKE :query 
            OR u.name LIKE :query";

        $params = [':query' => '%' . $input . '%'];

        $data = $this->pdo->fetchAll($sql, $params);

        if (!$data) {
            return [];
        }

        $courses = [];
        foreach ($data as $row) {
            $course = new self();
            $course->setId($row['id']);
            $course->setTitle($row['title']);
            $course->setDescription($row['description']);
            $course->setContent($row['content']);
            $course->setImage($row['image']);

            $teacher = new User();
            $teacher->setId($row['teacher_id']);
            $teacher->setName($row['teacher_name']);
            $course->setTeacher($teacher);

            $category = new Category();
            $category->setId($row['category_id']);
            $category->setName($row['category_name']);
            $course->setCategory($category);

            $courseTag = new CourseTag();
            $courseTag->setCourseId($row['id']);
            $tags = $courseTag->getTagsByCourse();
            $course->setTags($tags);

            $courses[] = $course;
        }

        return $courses;
    }
}
