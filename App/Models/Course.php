<?php

abstract class Course
{
    protected Database $pdo;
    protected ?int $id;
    protected string $title;
    protected string $description;
    protected string $content;
    protected ?string $image;
    protected User $teacher;
    protected Category $category;
    protected array $tags;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
        $this->id = null;
        $this->title = '';
        $this->description = '';
        $this->content = '';
        $this->image = null;
        $this->teacher = new User();
        $this->category = new Category();
        $this->tags = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return ucfirst($this->title);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImage(): string {
        return $this->image ?? '/Assets/default.webp';
    }

    public function getTeacher(): User
    {
        return $this->teacher;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getTags(): array
    {
        return $this->tags;
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

    public function setImage(?string $path): void {
        $this->image = $path;
    }

    public function setTeacher(User $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    
    
    public function saveTags(): void{
        $this->deleteTags();
        
        foreach($this->tags as $tag){
            $courseTag = new CourseTag();
            $courseTag->setTagId($tag->getId());
            $courseTag->setCourseId($this->id);
            $courseTag->add();
        }
    }
    
    public function deleteTags(): void {
        $courseTag = new CourseTag();
        $courseTag->setCourseId($this->id);
        $courseTag->removeAllTags();
    }
    
    public function delete(): bool
    {
        if (!$this->id) {
            return false;
        }
        
        $this->deleteTags();
        
        $query = "DELETE FROM courses WHERE id = :id";
        return $this->pdo->execute($query, ['id' => $this->id]);
    }
    

    abstract public function save(): bool;
    abstract public function getById(): ?self;
    abstract public function getAll(): array;
    
}