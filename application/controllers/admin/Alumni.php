<?php
class Alumni extends CI_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
	function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['logged_in'])) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->library('form_validation');
		$this->load->model('m_alumni');
		$this->load->library('upload');
	}


	function index()
	{
		$x['data'] = $this->m_alumni->get_all_alumni();
		$x['judul'] = 'Kemala | Alumni';
		$this->load->view('admin/v_alumni', $x);
	}

	function simpan_alumni()
	{
		$nama = $this->input->post('xnama');
		$angkatan = $this->input->post('xangkatan');
		$fakultas = $this->input->post('xfakultas');
		$nohp = $this->input->post('xkontak');
		$data = array(
			'alumni_nama' => $nama,
			'alumni_angkatan' => $angkatan,
			'alumni_fakultas' => $fakultas,
			'alumni_nohp' => $nohp,

		);
		$this->m_alumni->simpan_alumni($data);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Alumni');
	}

	function update_alumni()
	{
		$nama = $this->input->post('xnama');
		$angkatan = $this->input->post('xangkatan');
		$fakultas = $this->input->post('xfakultas');
		$nohp = $this->input->post('xkontak');
		$id = $this->input->post('xid');
		$where = array(
			'alumni_id' => $id,
		);
		$data = array(
			'alumni_nama' => $nama,
			'alumni_angkatan' => $angkatan,
			'alumni_fakultas' => $fakultas,
			'alumni_nohp' => $nohp,

		);
		$this->m_alumni->update_alumni($where, $data);
		echo $this->session->set_flashdata('msg', 'info');
		redirect('admin/Alumni');
	}

	function hapus_alumni()
	{
		$id = $this->input->post('xid');
		$data = $this->m_alumni->get_all_alumniById($id);
		$this->m_alumni->hapus_alumni($id);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('admin/Alumni');
	}

	//import

	function import()
	{
		// Load plugin PHPExcel nya
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$csvreader = PHPExcel_IOFactory::createReader('CSV');
		$loadcsv = $csvreader->load('csv/' . $this->filename . '.csv'); // Load file yang tadi diupload ke folder csv
		$sheet = $loadcsv->getActiveSheet()->getRowIterator();

		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = [];

		$numrow = 1;
		foreach ($sheet as $row) {
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if ($numrow > 1) {
				// START -->
				// Skrip untuk mengambil value nya
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

				$get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
				foreach ($cellIterator as $cell) {
					array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
				}
				// <-- END

				// Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
				$nama = $get[0]; // Ambil data Nim dari kolom A di csv
				$angkatan = $get[1]; // Ambil data nama dari kolom B di csv
				$fakultas = $get[2]; // Ambil data prodi dari kolom C di csv
				$nohp = $get[3]; // Ambil data email dari kolom D di csv

				// Kita push (add) array data ke variabel data			
				array_push($data, [
					'alumni_nama' => $nama, // Insert data nama
					'alumni_angkatan' => $angkatan, // Insert data angkatan
					'alumni_fakultas' => $fakultas, // Insert data fakultas
					'alumni_nohp' => $nohp, // Insert data nohp

				]);
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->m_alumni->insert_multiple($data);

		redirect('admin/Alumni'); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
	function form()
	{
		$data = array(); // Buat variabel $data sebagai array

		if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada Mahasiswa_model.php
			$upload = $this->m_alumni->upload_file($this->filename);

			if ($upload['result'] == "success") { // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

				$csvreader = PHPExcel_IOFactory::createReader('CSV');
				$loadcsv = $csvreader->load('csv/' . $this->filename . '.csv'); // Load file yang tadi diupload ke folder csv
				$sheet = $loadcsv->getActiveSheet()->getRowIterator();

				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam csv yang sudha di upload sebelumnya
				$data['sheet'] = $sheet;
			} else { // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		$data['judul'] = 'Kemala | Import  Alumni';

		$this->load->view('admin/v_importdataalumni', $data);
	}
}
