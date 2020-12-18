<?php

class Category extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model', 'category_model');
    }

    /**
     * Обновление категорий
     */
    public function update()
    {
        $data = $this->input->post();

        $categories = isset($data['categories']) ? $data['categories'] : false;
        $createCategories = isset($data['create_categories']) ? $data['create_categories'] : false;

        $ids = [];
        $deleteIds = [];

        try {
            if ($categories) {
                foreach ($categories as $key => $category)
                    $this->category_model->update($key, ['title' => $category]);


                $keys = array_keys($categories);
                if (count($keys)) {
                    $oldCategories = $this->category_model->getByNotIds($keys);
                    $deleteIds = array_column($oldCategories, 'id');
                    $this->category_model->deleteWhereNot($keys);
                }
            } else {
                $oldCategories = $this->category_model->getByNotIds([]);
                $deleteIds = array_column($oldCategories, 'id');
                $this->category_model->deleteWhereIn($deleteIds);
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
     * Вывод формы для категорий
     */
    public function formModalView()
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
}