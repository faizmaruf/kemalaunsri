<?php
class Tulisan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['logged_in'])) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('m_kategori');
		$this->load->model('m_tulisan');
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}


	function index()
	{
		$x['data'] = $this->m_tulisan->get_all_tulisan();
		$x['judul'] = 'Kemala | Tulisan';
		$this->load->view('admin/v_tulisan', $x);
	}
	function add_tulisan()
	{
		$x['kat'] = $this->m_kategori->get_all_kategori();
		$x['judul'] = 'Kemala | Add Tulisan';
		$this->load->view('admin/v_add_tulisan', $x);
	}
	function get_edit()
	{
		$kode = $this->uri->segment(4);
		$x['data'] = $this->m_tulisan->get_tulisan_by_kode($kode);
		$x['kat'] = $this->m_kategori->get_all_kategori();
		$x['judul'] = 'Kemala | Edit Tulisan';
		$this->load->view('admin/v_edit_tulisan', $x);
	}
	function simpan_tulisan()
	{
		$config['upload_path'] = './assets/images/tulisan/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = true; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/tulisan/' . $gbr['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '60%';
				$config['width'] = 840;
				$config['height'] = 450;
				$config['new_image'] = './assets/images/tulisan/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$judul = strip_tags($this->input->post('xjudul'));
				$filter = str_replace("?", "", $judul);
				$filter2 = str_replace("$", "", $filter);
				$pra_slug = $filter2 . '.html';
				$slug = strtolower(str_replace(" ", "-", $pra_slug));
				$isi = $this->input->post('xisi');
				$kategori_id = strip_tags($this->input->post('xkategori'));
				$data = $this->m_kategori->get_kategori_byid($kategori_id);
				$q = $data->row_array();
				$kategori_nama = $q['kategori_nama'];
				$kode = $this->session->userdata('idadmin');
				$user = $this->m_pengguna->get_pengguna_login($kode);
				$p = $user->row_array();
				$user_id = $p['pengguna_id'];
				$user_nama = $this->input->post('xpenulis');
				$this->m_tulisan->simpan_tulisan($judul, $isi, $kategori_id, $kategori_nama, $user_id, $user_nama, $gambar, $slug);
				echo $this->session->set_flashdata('msg', 'success');
				redirect('admin/tulisan');
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/tulisan');
			}
		} else {
			redirect('admin/tulisan');
		}
	}

	function update_tulisan()
	{
		$photo = $this->input->post('xphoto');
		$path = './assets/images/tulisan/' . $photo;
		unlink($path);
		$config['upload_path'] = './assets/images/tulisan/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = true; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/tulisan/' . $gbr['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '60%';
				$config['width'] = 840;
				$config['height'] = 450;
				$config['new_image'] = './assets/images/tulisan/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$tulisan_id = $this->input->post('kode');
				$judul = strip_tags($this->input->post('xjudul'));
				$filter = str_replace("?", "", $judul);
				$filter2 = str_replace("$", "", $filter);
				$pra_slug = $filter2 . '.html';
				$slug = strtolower(str_replace(" ", "-", $pra_slug));
				$isi = $this->input->post('xisi');
				$kategori_id = strip_tags($this->input->post('xkategori'));
				$data = $this->m_kategori->get_kategori_byid($kategori_id);
				$q = $data->row_array();
				$kategori_nama = $q['kategori_nama'];
				$kode = $this->session->userdata('idadmin');
				$user = $this->m_pengguna->get_pengguna_login($kode);
				$p = $user->row_array();
				$user_id = $p['pengguna_id'];
				$user_nama = $this->input->post('xpenulis');
				$this->m_tulisan->update_tulisan($tulisan_id, $judul, $isi, $kategori_id, $kategori_nama, $user_id, $user_nama, $gambar, $slug);
				echo $this->session->set_flashdata('msg', 'info');
				redirect('admin/tulisan');
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna');
			}
		} else {
			$tulisan_id = $this->input->post('kode');
			$judul = strip_tags($this->input->post('xjudul'));
			$filter = str_replace("?", "", $judul);
			$filter2 = str_replace("$", "", $filter);
			$pra_slug = $filter2 . '.html';
			$slug = strtolower(str_replace(" ", "-", $pra_slug));
			$isi = $this->input->post('xisi');
			$kategori_id = strip_tags($this->input->post('xkategori'));
			$data = $this->m_kategori->get_kategori_byid($kategori_id);
			$q = $data->row_array();
			$kategori_nama = $q['kategori_nama'];
			$kode = $this->session->userdata('idadmin');
			$user = $this->m_pengguna->get_pengguna_login($kode);
			$p = $user->row_array();
			$user_id = $p['pengguna_id'];
			$user_nama = $p['pengguna_nama'];
			$this->m_tulisan->update_tulisan_tanpa_img($tulisan_id, $judul, $isi, $kategori_id, $kategori_nama, $user_id, $user_nama, $slug);
			echo $this->session->set_flashdata('msg', 'info');
			redirect('admin/tulisan');
		}
	}

	function hapus_tulisan()
	{
		$kode = $this->input->post('kode');
		$gambar = $this->input->post('gambar');
		$path = './assets/images/tulisan/' . $gambar;
		unlink($path);
		$this->m_tulisan->hapus_tulisan($kode);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('admin/tulisan');
	}
}
