<?php
class Coverpage extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['logged_in'])) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('m_coverpage');
		$this->load->library('upload');
	}


	function index()
	{

		$x['data'] = $this->m_coverpage->get_all_coverpage();
		$x['judul'] = 'Kemala | Coverpage';
		$this->load->view('admin/v_coverpage', $x);
	}

	function simpan_coverpage()
	{
		$config['upload_path'] = './theme/images/coverpage/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = true; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
	                        //Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './theme/images/coverpage/' . $gbr['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '100%';
				// $config['width'] = 1900;
				// $config['height'] = 1080;
				$config['new_image'] = './theme/images/coverpage/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$judul = strip_tags($this->input->post('xjudul'));
				
			

                $this->m_coverpage->simpan_coverpage($judul, $gambar);
				echo $this->session->set_flashdata('msg', 'success');
				redirect('admin/coverpage');
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/coverpage');
			}

		} else {
			redirect('admin/coverpage');
		}

	}

	function update_coverpage()
	{

		$config['upload_path'] = './theme/images/coverpage/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = true; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
	                        //Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './theme/images/coverpage/' . $gbr['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '100%';
				$config['width'] = 1900;
				$config['height'] = 1080;
				$config['new_image'] = './theme/images/coverpage/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$coverpage_id = $this->input->post('kode');
				$judul = strip_tags($this->input->post('xjudul'));
				$images = $this->input->post('gambar');
				$path = './theme/images/coverpage/' . $images;
				unlink($path);
			
                $this->m_coverpage->update_coverpage($judul, $gambar);
				echo $this->session->set_flashdata('msg', 'info');
				redirect('admin/coverpage');

			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/coverpage');
			}

		} else {
			$coverpage_id = $this->input->post('kode');
            $judul = strip_tags($this->input->post('xjudul'));
            
            $this->m_coverpage->update_coverpage($judul, $gambar);
			echo $this->session->set_flashdata('msg', 'info');
			redirect('admin/coverpage');
		}

	}

	function hapus_coverpage()
	{
		$kode = $this->input->post('kode');
		$gambar = $this->input->post('gambar');
		$path = './theme/images/coverpage/' . $gambar;
		unlink($path);
		$this->m_coverpage->hapus_coverpage($kode);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('admin/coverpage');
	}

}