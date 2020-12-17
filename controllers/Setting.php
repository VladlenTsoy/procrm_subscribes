<?php

class Setting extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model', 'category_model');
        $this->load->model('Subscribe_model', 'subscribe_model');
    }

    public function index()
    {
        $data = ['title' => _l('settings')];
        $this->load->view('setting/index', $data);
    }

    /**
     *
     * @param $categoryId
     */
    public function content($categoryId = false)
    {
        try {
            if ($categoryId) {
                $category = $this->category_model->getById($categoryId);
                $data = ['category' => $category];

                echo json_encode([
                    'status' => 'success',
                    'html' => [
                        'title' => $this->load->view('setting/tabs/tab_title', $data, true),
                        'content' => $this->load->view('setting/tabs/tab_content', $data, true)
                    ]
                ]);
            } else {
                $categories = $this->category_model->getAll();
                $data = ['categories' => $categories];

                echo json_encode([
                    'status' => 'success',
                    'html' => $this->load->view('setting/tabs/tabs', $data, true)
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e
            ]);
        }
    }
}