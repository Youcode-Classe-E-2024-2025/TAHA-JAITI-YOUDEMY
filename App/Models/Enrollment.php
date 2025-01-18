<?php


class Enrollment
{

    private Database $pdo;
    private int $course_id;
    private int $student_id;

    public function __construct(int $course, int $user)
    {
        $this->course_id = $course;
        $this->student_id = $user;
        $this->pdo = new Database();
    }

    public function getCourse()
    {
        return $this->course_id;
    }

    public function setCourse(int $course)
    {
        $this->course_id = $course;
    }

    public function getStudent()
    {
        return $this->student_id;
    }


    public function setStudent($student)
    {
        $this->student_id = $student;
    }

    public function enroll(): bool{
        $sql = "INSERT INTO enrollments(student_id, course_id) VALUES (:uid, :cid)";
        return $this->pdo->execute($sql, [
            ':uid' => $this->student_id,
            ':cid' => $this->course_id
        ]);
    }

}
