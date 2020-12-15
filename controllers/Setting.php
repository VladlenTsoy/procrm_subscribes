<?php

class Setting extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model', 'category_model');
        $this->load->model('Subscribe_model', 'subscribe_model');
    }

    public function index () {
        $categories = $this->category_model->getAll();
        $subscribes = $this->subscribe_model->getAll();
        $this->load->view('index/index', ['categories' => $categories, 'subscribes' => $subscribes]);
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

    /**
     *
     */
    public function subscribe() {
        $data = $this->input->post();

        $data['time'] = json_encode($data['time']);
        $subscribeId = $this->subscribe_model->create($data);

        if($subscribeId)
            echo json_encode(['status' => 'success']);
        else
            echo json_encode(['status' => 'success']);
    }
}