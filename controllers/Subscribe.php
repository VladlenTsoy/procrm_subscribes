<?php

class Subscribe extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model', 'category_model');
        $this->load->model('Subscribe_model', 'subscribe_model');
    }

    /**
     * Создать абонемент
     */
    public function create()
    {
        $data = $this->input->post();

        $data['time'] = json_encode($data['time']);
        $subscribeId = $this->subscribe_model->create($data);

        if ($subscribeId)
            echo json_encode([
                'status' => 'success',
                'category_id' => $data['category_id'],
                'message' => _l('you_have_successfully_created_your_subscription')
            ]);
        else
            echo json_encode(['status' => 'error']);
    }


    /**
     * Обновить абонемент
     */
    public function update()
    {
        $data = $this->input->post();

        $data['time'] = json_encode($data['time']);
        $result = $this->subscribe_model->updateById($data['id'], $data);

        if ($result)
            echo json_encode([
                'status' => 'success',
                'message' => _l('you_have_successfully_edit_your_subscription'),
                'category_id' => $data['category_id']
            ]);
        else
            echo json_encode(['status' => 'error']);
    }

    /**
     * Удалить абонемент
     * @param $id
     */
    public function delete($id)
    {
        $result = $this->subscribe_model->deleteById($id);

        if ($result)
            echo json_encode([
                'status' => 'success',
                'message' => _l('you_have_successfully_deleted_your_subscription')
            ]);
        else
            echo json_encode(['status' => 'error', 'message' => _l('unknown_error')]);
    }


    /**
     * Вывод формы
     * @param bool $subscribeId
     */
    public function formModalView($subscribeId = false)
    {
        $categories = $this->category_model->getAll();

        if ($subscribeId) {
            $subscribe = $this->subscribe_model->getById($subscribeId);

            if ($subscribe) {
                $subscribe['time'] = json_decode($subscribe['time'], true);
                $data = [
                    'subscribe' => $subscribe,
                    'categories' => $categories,
                ];

                echo json_encode([
                    'status' => 'success',
                    'html' => $this->load->view('setting/subscribe/edit_form', $data, true)
                ]);
            } else
                echo json_encode([
                    'status' => 'error',
                ]);
        } else {
            $data = [
                'categories' => $categories,
            ];

            echo json_encode([
                'status' => 'success',
                'html' => $this->load->view('setting/subscribe/create_form', $data, true)
            ]);
        }
    }
}