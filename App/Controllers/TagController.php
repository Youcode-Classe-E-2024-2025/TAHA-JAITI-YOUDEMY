<?php

class TagController extends Controller
{
    private Tag $tagModel;

    public function __construct()
    {
        parent::__construct();
        $this->tagModel = new Tag();
    }
    
    public function getAll()
    {
        $tags = $this->tagModel->getAll();
        return $tags;
    }

    public function create()
    {
        if (!$this->validateToken($_POST['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-tags');
        }

        $data = $this->getData();

        $tagNames = $data['name'];

        if (empty($tagNames)) {
            $_SESSION['error'] = 'Tag names are required.';
            $this->redirect('/manage-tags');
        }

        $tagNames = array_map('trim', explode(',' ,$tagNames));
        $tagNames = array_filter($tagNames);

        $success = 0;
        $bad = 0;

        if (empty($tagNames)) {
            $_SESSION['error'] = 'Invalid tag names.';
            $this->redirect('/manage-tags');
        }

        foreach ($tagNames as $tag){
            $this->tagModel->setName($tag);
            if ($this->tagModel->create()){
                $success++;
            } else {
                $bad++;
            }
        }

        if ($bad === 0) {
            $_SESSION['success'] = "All tags created successfully.";
        } else {
            $_SESSION['error'] = "Created $success tags, but $bad failed.";
        }

        $this->redirect('/manage-tags');
    }

    public function delete()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            $this->redirect('/manage-tags');
        }

        $id = intval($_GET['id']);

        if (empty($id)) {
            $_SESSION['error'] = 'Tag ID is required.';
            $this->redirect('/manage-tags');
        }

        $this->tagModel->setId($id);

        if ($this->tagModel->delete()) {
            $_SESSION['success'] = 'Tag deleted successfully.';
        } else {
            $_SESSION['error'] = 'Failed to delete tag.';
        }

        $this->redirect('/manage-tags');
    }
}