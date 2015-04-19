<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("my_layout"); // Sử dụng thư viện layout
        $this->my_layout->setLayout("layout/frontend"); // load file layout chính (views/layout/frontend.php)
    }

    public function index()
    {
        $data['data']['province'] = $this->db->from('province')->get()->result_array();
        $this->my_layout->view("frontend/home/index", isset($data)?$data:NULL);
    }

    public function test(){
        $this->my_layout->view("frontend/home/test");
    }

    function loaddist(){
        $provinceid = $this->input->post('provinceid');
        $data= $this->db->where(array('provinceid' => $provinceid ))->from('district')->get()->result_array();
        $result ="";
        foreach ($data as $key => $val) {
            $result .= "<option value=".$val['districtid'].">";
            $result .= $val['name'];
            $result .= "</option>";
        }
        echo $result;
    }

     function loadward(){
        $distid = $this->input->post('distid');
        $data= $this->db->where(array('districtid' => $distid ))->from('ward')->get()->result_array();
        $result ="";
        foreach ($data as $key => $val) {
            $result .= "<option value=".$val['wardid'].">";
            $result .= $val['name'];
            $result .= "</option>";
        }
        echo $result;
    }

    

}
