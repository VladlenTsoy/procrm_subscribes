<?php

class Setting extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model', 'category_model');
    }

    public function index () {
        $categories = $this->category_model->getAll();
        $this->load->view('index/index', ['categories' => $categories]);
    }

    /**
     * Создать категорию
     */
    public function category() {
        $data = $this->input->post();
        $categoryId = $this->category_model->create($data);

        if($categoryId)
            echo json_encode(['status' => 'success']);
        else
            echo json_encode(['status' => 'success']);
    }
}