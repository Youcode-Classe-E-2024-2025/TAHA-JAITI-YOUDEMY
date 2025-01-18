<?php

class CategoryController extends Controller
{
    private Category $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function getAll()
    {
        $categories = $this->categoryModel->getAll();
        return $categories;
    }

    public function create()
    {
        if (!$this->validateToken($_POST['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-categories');
        }

        $data = $this->getData();

        $name = $data['name'];

        if (empty($name)) {
            $_SESSION['error'] = 'Category name is required.';
            $this->redirect('/manage-categories');
        }

        $this->categoryModel->setName($name);

        if ($this->categoryModel->create()) {
            $_SESSION['success'] = 'Category created successfully.';
        } else {
            $_SESSION['error'] = 'Failed to create category.';
        }

        $this->redirect('/manage-categories');
    }

    public function update()
    {
        if (!$this->validateToken($_POST['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-categories');
        }

        $data = $this->getData();

        $id = $data['id'];
        $name = $data['name'];

        if (empty($id) || empty($name)) {
            $_SESSION['error'] = 'Category ID and name are required.';
            $this->redirect('/manage-categories');
        }

        $this->categoryModel->setId($id);
        $this->categoryModel->setName($name);

        if ($this->categoryModel->update()) {
            $_SESSION['success'] = 'Category updated successfully.';
        } else {
            $_SESSION['error'] = 'Failed to update category.';
        }

        $this->redirect('/manage-categories');
    }
    public function delete()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-categories');
        }

        $id = intval($_GET['id']);

        if (empty($id)) {
            $_SESSION['error'] = 'Category ID is required.';
            $this->redirect('/manage-categories');
        }

        $this->categoryModel->setId($id);

        if ($this->categoryModel->delete()) {
            $_SESSION['success'] = 'Category deleted successfully.';
        } else {
            $_SESSION['error'] = 'Failed to delete category.';
        }

        $this->redirect('/manage-categories');
    }
}
