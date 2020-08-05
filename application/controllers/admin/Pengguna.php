<?php
class Pengguna extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['logged_in'])) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}


	function index()
	{
		$kode = $this->session->userdata('idadmin');
		$x['user'] = $this->m_pengguna->get_pengguna_login($kode);
		$x['data'] = $this->m_pengguna->get_all_pengguna();
		$x['judul'] = 'Kemala | Pengguna';
		$this->load->view('admin/v_pengguna', $x);
	}

	function simpan_pengguna()
	{
		$config['upload_path'] = './assets/images/admin/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = true; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/admin/' . $gbr['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/admin/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');

				$data = array(
					'pengguna_nama' => $nama,
					'pengguna_jenkel' => $jenkel,
					'pengguna_username' => $username,
					'pengguna_password' => md5($password),
					'pengguna_email' => $email,
					'pengguna_nohp' => $nohp,
					'pengguna_level' => $level,
					'pengguna_photo' => $gambar,

				);

				if ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('admin/pengguna');
				} else {
					$this->m_pengguna->simpan_pengguna($data);
					echo $this->session->set_flashdata('msg', 'success');
					redirect('admin/pengguna');
				}
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna');
			}
		} else {
			$nama = $this->input->post('xnama');
			$jenkel = $this->input->post('xjenkel');
			$username = $this->input->post('xusername');
			$password = $this->input->post('xpassword');
			$konfirm_password = $this->input->post('xpassword2');
			$email = $this->input->post('xemail');
			$nohp = $this->input->post('xkontak');
			$level = $this->input->post('xlevel');
			$data = array(
				'pengguna_nama' => $nama,
				'pengguna_jenkel' => $jenkel,
				'pengguna_username' => $username,
				'pengguna_password' => md5($password),
				'pengguna_email' => $email,
				'pengguna_nohp' => $nohp,
				'pengguna_level' => $level,

			);
			if ($password <> $konfirm_password) {
				echo $this->session->set_flashdata('msg', 'error');
				redirect('admin/pengguna');
			} else {
				$this->m_pengguna->simpan_pengguna_tanpa_gambar($data);
				echo $this->session->set_flashdata('msg', 'success');
				redirect('admin/pengguna');
			}
		}
	}

	function update_pengguna()
	{

		$config['upload_path'] = './assets/images/admin/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = true; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/admin/' . $gbr['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/admin/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];

				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				$id = $this->input->post('xid');
				$where = array(
					'pengguna_id' => $id,
				);
				$data = array(
					'pengguna_id' => $id,
					'pengguna_nama' => $nama,
					'pengguna_jenkel' => $jenkel,
					'pengguna_username' => $username,
					'pengguna_password' => md5($password),
					'pengguna_email' => $email,
					'pengguna_nohp' => $nohp,
					'pengguna_level' => $level,
					'pengguna_photo' => $gambar,

				);

				if ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('admin/pengguna');
				} else {
					$this->m_pengguna->update_pengguna($where, $data);
					echo $this->session->set_flashdata('msg', 'info');
					redirect('admin/pengguna');
				}
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna');
			}
		} else {

			$nama = $this->input->post('xnama');
			$jenkel = $this->input->post('xjenkel');
			$username = $this->input->post('xusername');
			$password = $this->input->post('xpassword');
			$konfirm_password = $this->input->post('xpassword2');
			$email = $this->input->post('xemail');
			$nohp = $this->input->post('xkontak');
			$level = $this->input->post('xlevel');
			$id = $this->input->post('xid');
			$where = array(
				'pengguna_id' => $id,
			);
			$data = array(
				'pengguna_id' => $id,
				'pengguna_nama' => $nama,
				'pengguna_jenkel' => $jenkel,
				'pengguna_username' => $username,
				'pengguna_password' => md5($password),
				'pengguna_email' => $email,
				'pengguna_nohp' => $nohp,
				'pengguna_level' => $level,

			);
			if ($password <> $konfirm_password) {
				echo $this->session->set_flashdata('msg', 'error');
				redirect('admin/pengguna');
			} else {
				$this->m_pengguna->update_pengguna_tanpa_gambar($data);
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna');
			}
		}
	}

	function hapus_pengguna()
	{
		$id = $this->input->post('xid');
		$data = $this->m_pengguna->get_pengguna_login($id);
		$q = $data->row_array();
		$p = $q['pengguna_photo'];
		$path =  './assets/images/admin/' . $p;
		unlink($path);
		$this->m_pengguna->hapus_pengguna($id);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('admin/pengguna');
	}

	function reset_password()
	{

		$id = $this->uri->segment(4);
		$get = $this->m_pengguna->getusername($id);
		if ($get->num_rows() > 0) {
			$a = $get->row_array();
			$b = $a['pengguna_username'];
		}
		$pass = rand(123456, 999999);
		$this->m_pengguna->resetpass($id, $pass);
		echo $this->session->set_flashdata('msg', 'show-modal');
		echo $this->session->set_flashdata('uname', $b);
		echo $this->session->set_flashdata('upass', $pass);
		redirect('admin/pengguna');
	}
}
