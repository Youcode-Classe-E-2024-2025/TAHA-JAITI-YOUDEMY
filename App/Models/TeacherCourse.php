<?php

class TeacherCourse extends Course
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save(): bool
    {
        if ($this->id) {
            $existing = $this->getById();

            if (!$existing || $existing->getTeacher()->getId() !== Session::getId()){
                throw New Exception('You dont have the permission to update this course');
            }

            $query = "UPDATE courses SET title = :title, description = :description, content = :content, image = :image, teacher_id = :teacher_id, category_id = :category_id WHERE id = :id";
            $params = [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'content' => $this->content,
                'image' => $this->image,
                'teacher_id' => Session::getId(),
                'category_id' => $this->category->getId(),
            ];
        } else {
            $query = "INSERT INTO courses (title, description, content, image, teacher_id, category_id) VALUES (:title, :description, :content, :image, :teacher_id, :category_id)";
            $params = [
                'title' => $this->title,
                'description' => $this->description,
                'content' => $this->content,
                'image' => $this->image,
                'teacher_id' => Session::getId(),
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

    public function delete(): bool {
        if (!$this->id) {
            return false;
        }

        $existing = $this->getById();
        if (!$existing || $existing->getTeacher()->getId() !== Session::getId()) {
            throw new Exception("You dont have permission to delete this course");
        }

        $this->deleteTags();

        $query = "DELETE FROM courses WHERE id = :id";
        return $this->pdo->execute($query, ['id' => $this->id]);
    }

    public function getById(): Course|null {
        $query = "SELECT * FROM courses WHERE id = :id AND teacher_id = :t_id";
        $data = $this->pdo->fetch($query, ['id' => $this->id, 't_id' => Session::getId()]);

        if (!$data) {
            return null;
        }

        $course = new self();
        $course->setId($data['id']);
        $course->setTitle($data['title']);
        $course->setDescription($data['description']);
        $course->setContent($data['content']);
        $course->setImage($data['image'] ?? __DIR__ . '/../../Assets/default.webp');

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

    public function getAll(): array {
        $query = "SELECT * FROM courses WHERE teacher_id = :id";
        $data = $this->pdo->fetchAll($query, ['id' => Session::getId()]);

        $courses = [];
        foreach ($data as $row) {
            $course = new self();
            $course->setId($row['id']);
            $course->setTitle($row['title']);
            $course->setDescription($row['description']);
            $course->setContent($row['content']);
            $course->setImage($row['image'] ?? __DIR__ . '../../Assets/default.webp');

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
