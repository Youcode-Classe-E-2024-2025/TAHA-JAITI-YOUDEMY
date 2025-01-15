<?php

class CourseTag
{

    private Database $pdo;
    private int $courseId;
    private int $tagId;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    public function setCourseId(int $id)
    {
        $this->courseId = $id;
    }

    public function setTagId(int $id)
    {
        $this->tagId = $id;
    }

    public function add(): bool
    {
        $sql = "INSERT INTO course_tag (course_id, tag_id) VALUES (:course_id, :tag_id)";
        return $this->pdo->execute($sql, [
            ':course_id' => $this->courseId,
            ':tag_id' => $this->tagId,
        ]);
    }

    public function removeAllTags(): bool
    {
        $sql = "DELETE FROM course_tag WHERE course_id = :course_id";
        return $this->pdo->execute($sql, [':course_id' => $this->courseId]);
    }

    public function getTagsByCourse(int $courseId): array
    {
        $sql = "SELECT t.* FROM tags t 
                JOIN course_tag ct ON t.id = ct.tag_id 
                WHERE ct.course_id = :course_id";
        $data = $this->pdo->fetchAll($sql, [':course_id' => $courseId]);

        $tags = [];
        foreach ($data as $tagData) {
            $tag = new Tag();
            $tag->setId($tagData['id']);
            $tag->setName($tagData['name']);
            $tags[] = $tag;
        }

        return $tags;
    }
}
