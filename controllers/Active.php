<?php

class Active extends AdminController
{
    public function index () {
        $this->load->view('active/index');
    }
}