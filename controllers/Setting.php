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
        $data = [
            'title' => _l('settings'),
        ];
        $this->load->view('setting/index', $data);
    }


    public function table()
    {
        $post = $this->input->post();
        $aColumns = ['id', 'category_id', 'title', 'time', 'duration', 'price', 'frost_days'];

        $sIndexColumn = 'id';
        $sTable = db_prefix() . 'procrm_subscribes';
        $sWhere = [];

        if (isset($post['filter_category_id']) && $post['filter_category_id'] !== 'all')
            $sWhere[] = 'AND category_id = ' . $post['filter_category_id'];

        $result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $sWhere);
        $output = $result['output'];
        $rResult = $result['rResult'];

        foreach ($rResult as $aRow) {
            $row = [];
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($i === 1) {
                    $_category = $this->category_model->getById($aRow[$aColumns[$i]]);
                    $row[] = $_category['title'];
                } else if ($i === 2) {
                    $_title = $aRow[$aColumns[$i]];
                    $_title .= '<div class="row-options">';
                    $_title .= '<a class="pointer edit-column" data-subscribe-id="' . $aRow['id'] . '">' . _l('edit') . '</a>';
                    $_title .= ' | <a class="pointer text-danger delete-column" data-subscribe-id="' . $aRow['id'] . '" data-category-id="' . $aRow['category_id'] . '">' . _l('delete') . '</a>';
                    $_title .= '</div>';
                    $row[] = $_title;
                } elseif ($i === 3) {
                    $time = json_decode($aRow[$aColumns[$i]], true);
                    $_time = $time['from']['hour'] . ':' . $time['from']['minute'] . ' - ' . $time['to']['hour'] . ':' . $time['to']['minute'];
                    $row[] = $_time;
                } elseif ($i === 4) {
                    $row[] = procrm_subscribes_mount($aRow[$aColumns[$i]]);
                } elseif ($i === 5) {
                    $_price = number_format($aRow[$aColumns[$i]], 0, ' ', ' ');
                    $row[] = $_price;
                } else
                    $row[] = $aRow[$aColumns[$i]];
            }

            $output['aaData'][] = $row;
        }

        echo json_encode($output);
    }


    public function formFilterBy()
    {
        $categories = $this->category_model->getAll();
        $data = ['categories' => $categories];

        echo json_encode([
            'status' => 'success',
            'html' => $this->load->view('setting/filter/form', $data, true)
        ]);
    }
}