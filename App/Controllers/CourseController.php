<?php

class CourseController extends Controller
{

    private Course $course;

    public function __construct()
    {
        $this->course = new Course();
    }

    public function getAll()
    {
        $courses = $this->course->getAll();
        return $courses;
    }

    public function create()
    {
        if (!$this->validateToken($_POST['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-courses');
        }

        $data = $this->getData();

        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $content = $data['content'] ?? '';
        $image = $_FILES['image'] ?? '';
        $teacher = $_SESSION['user']['role'] === 'teacher' ? $_SESSION['user']['id'] : 1;
        $category = $data['category_id'] ?? '';
        $tags = $data['tags'] ?? [];

        if (empty($title) || empty($description) || empty($content) || empty($category) || empty($tags)) {
            $_SESSION['error'] = 'All fields are required.';
            $this->redirect('/manage-courses');
        }

        $imgPath = null;

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $dir = __DIR__ . '/../../Assets';

            if (!mkdir($dir)) {
                mkdir($dir, 0755, true);
            }

            $imgName = uniqid() . '_' . basename($image);
            $imgPath = $dir . $imgName;

            if (!move_uploaded_file($image['tmp_name'], $imgPath)) {
                $_SESSION['error'] = 'Error uploading the file';
                $this->redirect('/managae-courses');
            }
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
            $_SESSION['error'] = 'Failed to create course';
            $this->redirect('/manage-courses');
        }


        $tagArray = [];
        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->setId(intval($tag));
            $tagArray[] = $newTag;
        }

        $course->setTags($tagArray);
        if (!$course->saveTags()) {
            $_SESSION['error'] = 'Failed to save tags';
            $this->redirect('/manage-courses');
        }

        $_SESSION['success'] = 'Course created successfully.';
        $this->redirect('/manage-courses');
    }

    public function delete()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-courses');
        }

        $id = intval($_GET['id']);

        if (empty($id)) {
            $_SESSION['error'] = 'Course ID is required.';
            $this->redirect('/manage-courses');
        }

        $this->course->setId($id);

        if ($this->course->delete()) {
            $_SESSION['success'] = 'Course deleted successfully';
        } else {
            $_SESSION['error'] = 'Failed to delete course';
        }

        $this->redirect('/manage-courses');
    }
}
