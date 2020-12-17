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
            echo json_encode(['status' => 'success', 'category_id' => $data['category_id']]);
        else
            echo json_encode(['status' => 'error']);
    }


    /**
     * Обновить абонемент
     * @param $id
     */
    public function edit($id)
    {
        $data = $this->input->post();

        $data['time'] = json_encode($data['time']);
        $result = $this->subscribe_model->updateById($id);

        if ($result)
            echo json_encode(['status' => 'success']);
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
            echo json_encode(['status' => 'success', 'message' => _l('you_have_successfully_deleted_your_subscription')]);
        else
            echo json_encode(['status' => 'error', 'message' => _l('unknown_error')]);
    }


    /**
     * Вывод формы
     * @param bool $subscribeId
     */
    public function formModalView ($subscribeId = false)
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


    /**
     * Таблица по категории id (DataTables)
     * @param $categoryId
     */
    public function table($categoryId)
    {
        $aColumns = ['id', 'title', 'time', 'duration', 'price', 'frost_days'];

        $sIndexColumn = 'id';
        $sTable = db_prefix() . 'procrm_subscribes';

        $result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], ['AND category_id = ' . $categoryId]);
        $output = $result['output'];
        $rResult = $result['rResult'];

        foreach ($rResult as $aRow) {
            $row = [];
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($i === 1) {
                    $_title = $aRow[$aColumns[$i]];
                    $_title .= '<div class="row-options">';
                    $_title .= '<a class="pointer edit-column" data-subscribe-id="' . $aRow['id'] . '">' . _l('edit') . '</a>';
                    $_title .= ' | <a class="pointer text-danger delete-column" data-subscribe-id="' . $aRow['id'] . '" data-category-id="' . $categoryId . '">' . _l('delete') . '</a>';
                    $_title .= '</div>';
                    $row[] = $_title;
                } elseif ($i === 2) {
                    $time = json_decode($aRow[$aColumns[$i]], true);
                    $_time = $time['from']['hour'] . ':' . $time['from']['minute'] . ' - ' . $time['to']['hour'] . ':' . $time['to']['minute'];
                    $row[] = $_time;
                } elseif ($i === 4) {
                    $_price = number_format($aRow[$aColumns[$i]], 0, ' ', ' ');
                    $row[] = $_price;
                } else
                    $row[] = $aRow[$aColumns[$i]];
            }

            $output['aaData'][] = $row;
        }

        echo json_encode($output);
    }
}