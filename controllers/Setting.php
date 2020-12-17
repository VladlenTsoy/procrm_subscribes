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

        $data = [
            'title' => _l('settings'),
            'categories' => $categories,
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

        $ids = [];
        $deleteIds = [];

        try {
            if ($categories) {
                foreach ($categories as $key => $category) {
                    $this->category_model->update($key, ['title' => $category]);
                }

                $keys = array_keys($categories);
                if (count($keys)) {
                    $oldCategories = $this->category_model->getByNotIds($keys);
                    $deleteIds = $arr = array_column($oldCategories, 'id');
                    $this->category_model->delete($keys);
                }
            }

            if ($createCategories)
                foreach ($createCategories as $key => $category) {
                    $categoryId = $this->category_model->create(['title' => $category]);
                    $ids[] = $categoryId;
                }

            echo json_encode([
                'status' => 'success',
                'message' => _l('you_have_successfully_updated_the_categories'),
                'categoryIds' => $ids,
                'deleteCategoryIds' => $deleteIds
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e]);
        }
    }

    /**
     * @param $categoryId
     */
    public function subscribes($categoryId)
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
                    $_title .= ' | <a class="pointer text-danger delete-column" data-subscribe-id="' . $aRow['id'] . '">' . _l('delete') . '</a>';
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

    /**
     *
     */
    public function subscribe()
    {
        $data = $this->input->post();

        $data['time'] = json_encode($data['time']);
        $subscribeId = $this->subscribe_model->create($data);

        if ($subscribeId)
            echo json_encode(['status' => 'success', 'category_id' => $data['category_id']]);
        else
            echo json_encode(['status' => 'success']);
    }


    /**
     * @return object|string
     */
    public function _tabCategoriesContent()
    {
        $categories = $this->category_model->getAll();

        $dataView = [
            'categories' => $categories,
        ];

        return $this->load->view('setting/tabs/tabs', $dataView, true);
    }

    /**
     * @param $categoryId
     * @return array
     */
    public function _tabCategoryContent($categoryId)
    {
        $category = $this->category_model->getById($categoryId);
        if ($category) {
            $data = ['category' => $category];
            return [
                'title' => $this->load->view('setting/tabs/tab_title', $data, true),
                'content' => $this->load->view('setting/tabs/tab_content', $data, true)
            ];
        }
    }


    /**
     * @param $id
     */
    public function content($id = false)
    {
        try {
            if ($id)
                echo json_encode([
                    'status' => 'success',
                    'html' => $this->_tabCategoryContent($id)
                ]);
            else
                echo json_encode([
                    'status' => 'success',
                    'html' => $this->_tabCategoriesContent()
                ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e
            ]);
        }
    }


    public function categoriescontent()
    {
        $categories = $this->category_model->getAll();

        $data = [
            'categories' => $categories,
        ];

        echo json_encode([
            'status' => 'success',
            'html' => $this->load->view('setting/categories/form', $data, true)
        ]);
    }

    public function subsctribebtncontent()
    {
        $categories = $this->category_model->getAll();

        $data = [
            'title' => _l('create_subscribe'),
            'categories' => $categories,
        ];

        echo json_encode([
            'status' => 'success',
            'html' => $this->load->view('setting/subscribe/editor_button', $data, true)
        ]);
    }

    public function subsctribeformcontent($subscribeId = false)
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
                'html' => $this->load->view('setting/subscribe/form', $data, true)
            ]);
        }
    }
}