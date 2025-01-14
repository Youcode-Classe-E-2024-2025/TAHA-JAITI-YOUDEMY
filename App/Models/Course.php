<?php

class Course
{
    private Database $pdo;
    private ?int $id;
    private string $title;
    private string $description;
    private string $content;
    private User $teacher;
    private Category $category;

    public function __construct()
    {
        $this->pdo = new Database();
        $this->id = null;
        $this->title = '';
        $this->description = '';
        $this->content = '';
        $this->teacher = new User();
        $this->category = new Category();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getTeacher(): User
    {
        return $this->teacher;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setTeacher(User $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function save(): bool
    {
        if ($this->id) {
            $query = "UPDATE courses SET title = :title, description = :description, content = :content, teacher_id = :teacher_id, category_id = :category_id WHERE id = :id";
            $params = [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'content' => $this->content,
                'teacher_id' => $this->teacher->getId(),
                'category_id' => $this->category->getId(),
            ];
        } else {
            $query = "INSERT INTO courses (title, description, content, teacher_id, category_id) VALUES (:title, :description, :content, :teacher_id, :category_id)";
            $params = [
                'title' => $this->title,
                'description' => $this->description,
                'content' => $this->content,
                'teacher_id' => $this->teacher->getId(),
                'category_id' => $this->category->getId(),
            ];
        }

        return $this->pdo->execute($query, $params);
    }

    public function delete(): bool
    {
        if (!$this->id) {
            return false;
        }

        $query = "DELETE FROM courses WHERE id = :id";
        return $this->pdo->execute($query, ['id' => $this->id]);
    }

    public function getById(): ?self
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

        $teacher = new User();
        $teacher->setId($data['teacher_id']);
        $course->setTeacher($teacher);

        $category = new Category();
        $category->setId($data['category_id']);
        $course->setCategory($category);

        return $course;
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM courses";
        $data = $this->pdo->fetchAll($query);

        $courses = [];
        foreach ($data as $row) {
            $course = new self();
            $course->setId($row['id']);
            $course->setTitle($row['title']);
            $course->setDescription($row['description']);
            $course->setContent($row['content']);

            $teacher = new User();
            $teacher->setId($row['teacher_id']);
            $course->setTeacher($teacher);

            $category = new Category();
            $category->setId($row['category_id']);
            $course->setCategory($category);

            $courses[] = $course;
        }

        return $courses;
    }
}