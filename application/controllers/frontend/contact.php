<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("my_layout"); // Sử dụng thư viện layout
        $this->my_layout->setLayout("layout/frontend"); // load file layout chính (views/layout/frontend.php)
    }

    public function index()
    {
        $this->my_layout->view("frontend/contact/index");
    }

}
