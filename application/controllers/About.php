<?php 
class About extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_pengunjung');
		$this->load->model('m_bph');
        $this->m_pengunjung->count_visitor();
	}

	function index(){
		$x['data'] = $this->m_bph->get_all_bph();
		$x['active'] = 'About';
		$x['judul'] = 'About us';
		$this->load->view('v_about',$x);
	}
}