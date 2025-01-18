<?php

class AdminCourse extends Course
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save(): bool
    {
        if ($this->id) {
            $query = "UPDATE courses SET title = :title, description = :description, content = :content, image = :image, teacher_id = :teacher_id, category_id = :category_id WHERE id = :id";
            $params = [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'content' => $this->content,
                'image' => $this->image,
                'teacher_id' => $this->teacher->getId(),
                'category_id' => $this->category->getId(),
            ];
        } else {
            $query = "INSERT INTO courses (title, description, content, image, teacher_id, category_id) VALUES (:title, :description, :content, :image, :teacher_id, :category_id)";
            $params = [
                'title' => $this->title,
                'description' => $this->description,
                'content' => $this->content,
                'image' => $this->image,
                'teacher_id' => $this->teacher->getId(),
                'category_id' => $this->category->getId(),
            ];
        }

        $result = $this->pdo->execute($query, $params);

        if ($result && !$this->id) {
            $this->id = $this->pdo->lastInsertId();
            return $result;
        }

        if ($result) {
            $this->saveTags();
        }

        return $result;
    }

    public function getById(): Course|null
    {
        $query = "SELECT * FROM courses WHERE id = :id";
        $data = $this->pdo->fetch($query, ['id' => $this->id]);

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

    public function getAll(): array
    {
        $query = "SELECT * FROM courses ORDER BY id ASC";
        $data = $this->pdo->fetchAll($query);

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

        return $courses;
    }
}
