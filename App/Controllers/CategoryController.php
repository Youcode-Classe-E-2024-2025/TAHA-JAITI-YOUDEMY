<?php

class CategoryController extends Controller
{
    private Category $categoryModel;

    public function __construct()
    {
        parent::__construct();
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
            Session::redirectErr('/manage-categories', 'Invalid CSRF token.');
            return;
        }

        $data = $this->getData();

        $name = $data['name'];

        if (empty($name)) {
            Session::redirectErr('/manage-categories', 'Category name is required.');
            return;
        }

        $this->categoryModel->setName($name);

        if ($this->categoryModel->create()) {
            Session::redirectSuccess('/manage-categories', 'Category created successfully.');
        } else {
            Session::redirectErr('/manage-categories', 'Failed to create category.');
        }
    }

    public function update()
    {
        if (!$this->validateToken($_POST['csrf'])) {
            Session::redirectErr('/manage-categories', 'Invalid CSRF token.');
            return;
        }

        $data = $this->getData();

        $id = $data['id'];
        $name = $data['name'];

        if (empty($id) || empty($name)) {
            Session::redirectErr('/manage-categories', 'Category ID and name are required.');
            return;
        }

        $this->categoryModel->setId($id);
        $this->categoryModel->setName($name);

        if ($this->categoryModel->update()) {
            Session::redirectSuccess('/manage-categories', 'Category updated successfully.');
        } else {
            Session::redirectErr('/manage-categories', 'Failed to update category.');
        }
    }

    public function delete()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            Session::redirectErr('/manage-categories', 'Invalid CSRF token.');
            return;
        }

        $id = intval($_GET['id']);

        if (empty($id)) {
            Session::redirectErr('/manage-categories', 'Category ID is required.');
            return;
        }

        $this->categoryModel->setId($id);

        if ($this->categoryModel->delete()) {
            Session::redirectSuccess('/manage-categories', 'Category deleted successfully.');
        } else {
            Session::redirectErr('/manage-categories', 'Failed to delete category.');
        }
    }
}