<?php

class Active extends AdminController
{
    public function index () {
        $data = [
            'title' => _l('active_subscribes')
        ];
        $this->load->view('active/index', $data);
    }
}