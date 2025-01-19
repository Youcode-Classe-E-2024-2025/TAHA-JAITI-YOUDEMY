<?php

class CourseController extends Controller
{

    private Course $course;

    public function __construct()
    {
        parent::__construct();
        $role = Session::getRole();
        switch ($role) {
            case 'admin':
                $this->course = new AdminCourse();
                break;
            case 'teacher':
                $this->course = new TeacherCourse();
                break;
            default:
                $this->course = new StudentCourse();
                break;
        }
    }

    public function getAll()
    {
        if ($this->course instanceof StudentCourse) {
            $page = intval($_GET['p'] ?? 1);
            $result = $this->course->getAll($page);
            return [
                'courses' => $result['courses'],
                'pagination' => $result['pagination']
            ];
        }

        $courses = $this->course->getAll();
        return $courses;
    }

    public function getById()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        if (!$id) {
            Session::redirectErr('/catalog', 'Invalid course ID.');
            return;
        }

        $this->course->setId($id);
        $course = $this->course->getById();

        return $course;
    }

    public function create()
    {
        if (!$this->validateToken($_POST['csrf'])) {
            Session::redirectErr('/manage-courses', 'Invalid CSRF token.');
            return;
        }

        $data = $this->getData();

        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $content = $data['content'] ?? '';
        $image = $_FILES['image'] ?? null;
        $teacher = Session::getRole() === 'teacher' ? Session::getId() : 1;
        $category = $data['category_id'] ?? '';
        $tags = $data['tags'] ?? [];

        if (empty($title) || empty($description) || empty($content) || empty($category) || empty($tags)) {
            Session::redirectErr('/manage-courses', 'All fields are required.');
            return;
        }

        $imgPath = null;
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $dir = __DIR__ . '/../../Assets';
            $imgName = uniqid() . '_' . basename($image['name']);
            $imgPath = $dir . '/' . $imgName;

            if (!move_uploaded_file($image['tmp_name'], $imgPath)) {
                Session::redirectErr('/manage-courses', 'Failed to upload the file.');
                return;
            }

            $imgPath = '/Assets/' . $imgName;
        }

        $course = $this->course;
        $course->setTitle($title);
        $course->setDescription($description);
        $course->setContent($content);
        $course->setImage($imgPath);

        $user = new User();
        $user->setId($teacher);
        $course->setTeacher($user);

        $cats = new Category();
        $cats->setId($category);
        $course->setCategory($cats);

        if (!$course->save()) {
            Session::redirectErr('/manage-courses', 'Failed to create course.');
            return;
        }

        $tagArray = [];
        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->setId(intval($tag));
            $tagArray[] = $newTag;
        }
        $course->setTags($tagArray);
        $course->saveTags();

        Session::redirectSuccess('/manage-courses', 'Course created successfully.');
    }

    public function delete()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            Session::redirectErr('/manage-courses', 'Invalid CSRF token.');
            return;
        }

        $id = intval($_GET['id']);

        if (empty($id)) {
            Session::redirectErr('/manage-courses', 'Course ID is required.');
            return;
        }

        $this->course->setId($id);

        if ($this->course->delete()) {
            Session::redirectSuccess('/manage-courses', 'Course deleted successfully.');
        } else {
            Session::redirectErr('/manage-courses', 'Failed to delete course.');
        }
    }
}
