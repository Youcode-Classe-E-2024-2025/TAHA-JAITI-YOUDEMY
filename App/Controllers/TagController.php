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
            Session::redirectErr('/manage-tags', 'Invalid CSRF token.');
            return;
        }

        $data = $this->getData();

        $tagNames = $data['name'] ?? '';

        if (empty($tagNames)) {
            Session::redirectErr('/manage-tags', 'Tag names are required.');
            return;
        }

        $tagNames = array_map('trim', explode(',', $tagNames));
        $tagNames = array_filter($tagNames);

        if (empty($tagNames)) {
            Session::redirectErr('/manage-tags', 'Invalid tag names.');
            return;
        }

        $success = 0;
        $bad = 0;

        foreach ($tagNames as $tag) {
            $this->tagModel->setName($tag);
            if ($this->tagModel->create()) {
                $success++;
            } else {
                $bad++;
            }
        }

        if ($bad === 0) {
            Session::redirectSuccess('/manage-tags', 'All tags created successfully.');
        } else {
            Session::redirectErr('/manage-tags', "Created $success tags, but $bad failed.");
        }
    }

    public function delete()
    {
        if (!$this->validateToken($_GET['csrf'])) {
            Session::redirectErr('/manage-tags', 'Invalid CSRF token.');
            return;
        }

        $id = intval($_GET['id']);

        if (empty($id)) {
            Session::redirectErr('/manage-tags', 'Tag ID is required.');
            return;
        }

        $this->tagModel->setId($id);

        if ($this->tagModel->delete()) {
            Session::redirectSuccess('/manage-tags', 'Tag deleted successfully.');
        } else {
            Session::redirectErr('/manage-tags', 'Failed to delete tag.');
        }
    }
}