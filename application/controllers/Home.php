<?php
class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_coverpage');
		$this->load->model('m_tulisan');
		$this->load->model('m_pengunjung');
		$this->load->model('m_anggota');
		$this->load->model('m_alumni');
		$this->m_pengunjung->count_visitor();
	}
	function index()
	{
		$x['jumlahanggota'] = $this->m_anggota->jumlah_anggota();
		$x['jumlahalumni'] = $this->m_alumni->jumlah_alumni();
		$x['active'] = 'Home';
		$x['judul'] = 'Kemala Unsri';
		$x['data'] = $this->m_coverpage->get_all_coverpage();
		$x['post'] = $this->m_tulisan->get_post_home();
		$this->load->view('v_home', $x);
	}
}
