<?php

class Active extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Leads_model', 'leads_model');
        $this->load->model('Subscribe_model', 'subscribe_model');
        $this->load->model('Active_subscribe_model', 'active_subscribe_model');
    }

    public function index()
    {
        $subscribes = $this->subscribe_model->getAll();
        $leads = $this->leads_model->get('', []);

        $data = [
            'title' => _l('active_subscribes'),
            'subscribes' => $subscribes,
            'leads' => $leads
        ];
        $this->load->view('active/index', $data);
    }

    public function table()
    {
        $post = $this->input->post();
        $aColumns = [
            db_prefix() . 'procrm_active_subscribes.id as id',
            db_prefix() . 'procrm_subscribes.title as subscribe',
            db_prefix() . 'leads.name as lead',
            'used_frost_days',
            'created_at',
            db_prefix() . 'procrm_subscribes.duration as duration',
            db_prefix() . 'procrm_subscribes.frost_days as frost_days'
        ];

        $sIndexColumn = 'id';
        $sTable = db_prefix() . 'procrm_active_subscribes';
        $sWhere = [];

        $join = [
            'LEFT JOIN ' . db_prefix() . 'procrm_subscribes ON ' . db_prefix() . 'procrm_subscribes.id = ' . db_prefix() . 'procrm_active_subscribes.subscribe_id',
            'LEFT JOIN ' . db_prefix() . 'leads ON ' . db_prefix() . 'leads.id = ' . db_prefix() . 'procrm_active_subscribes.lead_id',
        ];

//        if (isset($post['filter_category_id']) && $post['filter_category_id'] !== 'all')
//            $sWhere[] = 'AND category_id = ' . $post['filter_category_id'];

        $result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $sWhere);
        $output = $result['output'];
        $rResult = $result['rResult'];

//        var_dump($rResult);
//        var_dump($output);
        foreach ($rResult as $aRow) {
            $createdAt = strtotime($aRow['created_at']);
            $endAt = strtotime('+' . $aRow['duration'] . ' month');
            $datediff = $endAt - $createdAt;

            $row = [];
            $row[] = $aRow['id'];
            $row[] = $aRow['subscribe'];
            $row[] = $aRow['lead'];
            $row[] = '<div class="badge badge-success">Активный</div>';
            $row[] = round($datediff / (60 * 60 * 24)) . ' д';
            $row[] = $aRow['used_frost_days'] . ' д <small class="text-muted">\</small> ' . $aRow['frost_days'] . ' д';
            $row[] = date('d-m-Y', $createdAt);
            $row[] = '<button class="btn btn-primary btn-edit-active-subscribe"><i class="fa fa-edit"></i></button>';

            $output['aaData'][] = $row;
        }

        echo json_encode($output);
    }

    /**
     * Создание
     */
    public function create()
    {
        $post = $this->input->post();
        $this->active_subscribe_model->create($post);

        echo json_encode([
            'status' => 'success',
            'message' => 'Вы успешно добавили абонемент!'
        ]);
    }
}