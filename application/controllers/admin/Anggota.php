<?php
class Anggota extends CI_Controller
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
		$this->load->model('m_anggota');
		$this->load->library('upload');
	}


	function index()
	{
		$x['data'] = $this->m_anggota->get_all_anggota();
		$x['judul'] = 'Kemala | Anggota';
		$this->load->view('admin/v_anggota', $x);
	}

	function simpan_anggota()
	{



		$nama = $this->input->post('xnama');
		$angkatan = $this->input->post('xangkatan');
		$fakultas = $this->input->post('xfakultas');
		$nohp = $this->input->post('xkontak');
		$data = array(
			'anggota_nama' => $nama,
			'anggota_angkatan' => $angkatan,
			'anggota_fakultas' => $fakultas,
			'anggota_nohp' => $nohp,

		);
		$this->m_anggota->simpan_anggota($data);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/anggota');
	}

	function update_anggota()
	{
		$nama = $this->input->post('xnama');
		$angkatan = $this->input->post('xangkatan');
		$fakultas = $this->input->post('xfakultas');
		$nohp = $this->input->post('xkontak');
		$id = $this->input->post('xid');
		$where = array(
			'anggota_id' => $id,
		);
		$data = array(
			'anggota_nama' => $nama,
			'anggota_angkatan' => $angkatan,
			'anggota_fakultas' => $fakultas,
			'anggota_nohp' => $nohp,

		);
		$this->m_anggota->update_anggota($where, $data);
		echo $this->session->set_flashdata('msg', 'info');
		redirect('admin/anggota');
	}

	function hapus_anggota()
	{
		$id = $this->input->post('xid');
		$data = $this->m_anggota->get_all_anggotaById($id);
		$this->m_anggota->hapus_anggota($id);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('admin/anggota');
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
					'anggota_nama' => $nama, // Insert data nama
					'anggota_angkatan' => $angkatan, // Insert data angkatan
					'anggota_fakultas' => $fakultas, // Insert data fakultas
					'anggota_nohp' => $nohp, // Insert data nohp

				]);
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->m_anggota->insert_multiple($data);

		redirect('admin/Anggota'); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
	function form()
	{
		$data = array(); // Buat variabel $data sebagai array

		if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada Mahasiswa_model.php
			$upload = $this->m_anggota->upload_file($this->filename);

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
		$data['judul'] = 'Kemala | Import  Anggota';

		$this->load->view('admin/v_importdataanggota', $data);
	}
}
