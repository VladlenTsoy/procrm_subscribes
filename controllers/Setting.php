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
        $categories = $this->category_model->getAll();
        $subscribes = $this->subscribe_model->getAll();

        $data = [
            'title' => _l('settings'),
            'categories' => $categories,
            'subscribes' => $subscribes
        ];

        $this->load->view('setting/index', $data);
    }

    /**
     * Управление категориями
     */
    public function category()
    {
        $data = $this->input->post();

        $categories = isset($data['categories']) ? $data['categories'] : false;
        $createCategories = isset($data['create_categories']) ? $data['create_categories'] : false;

        try {
            if ($categories) {
                foreach ($categories as $key => $category) {
                    $this->category_model->update($key, ['title' => $category]);
                }

                $keys = array_keys($categories);
                $this->category_model->delete($keys);
            }

            if ($createCategories)
                foreach ($createCategories as $key => $category) {
                    $this->category_model->create(['title' => $category]);
                }


            $categories = $this->category_model->getAll();
            $subscribes = $this->subscribe_model->getAll();

            $dataView = [
                'categories' => $categories,
                'subscribes' => $subscribes
            ];

            echo json_encode([
                'status' => 'success',
                'message' => _l('you_have_successfully_updated_the_categories'),
                'html' => $this->load->view('setting/tabs/tabs', $dataView, true)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e]);
        }
    }

    /**
     *
     */
    public function subscribes($categoryId)
    {
//        $this->app->get_table_data('subscribes', ['category_id' => $categoryId]);


        $aColumns = ['id', 'title', 'time', 'duration', 'price', 'frost_days'];

        $sIndexColumn = 'id';
        $sTable = db_prefix() . 'procrm_subscribes';

        $result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], ['AND category_id = '.$categoryId]);
        $output = $result['output'];
        $rResult = $result['rResult'];

        foreach ($rResult as $aRow) {
            $row = [];
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($i === 2) {
                    $time = json_decode($aRow[$aColumns[$i]], true);
                    $_time = $time['from']['hour'] . ':' . $time['from']['minute'] . ' - ' . $time['to']['hour'] . ':' . $time['to']['minute'];
                    $row[] = $_time;
                } elseif ($i === 4) {
                    $_price = number_format($aRow[$aColumns[$i]], 0, ' ', ' ');
                    $row[] = $_price;
                } else
                    $row[] = $aRow[$aColumns[$i]];
            }
            $options = icon_btn('#', 'pencil-square-o', 'btn-default', ['data-toggle' => 'modal', 'data-target' => '#customer_group_modal', 'data-id' => $aRow['id']]);
            $row[] = $options .= icon_btn('clients/delete_group/' . $aRow['id'], 'remove', 'btn-danger _delete');

            $output['aaData'][] = $row;
        }

        echo json_encode($output);
    }

    /**
     *
     */
    public function subscribe()
    {
        $data = $this->input->post();

        $data['time'] = json_encode($data['time']);
        $subscribeId = $this->subscribe_model->create($data);

        if ($subscribeId)
            echo json_encode(['status' => 'success']);
        else
            echo json_encode(['status' => 'success']);
    }
}