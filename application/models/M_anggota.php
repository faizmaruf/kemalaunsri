<?php
class M_anggota extends CI_Model
{

    function get_all_anggota()
    {
        $hsl = $this->db->get('tbl_anggota');
        return $hsl;
    }

    function get_all_anggotaById($id)
    {
        $hsl = $this->db->get('tbl_anggota', $id);
        return $hsl;
    }

    function simpan_anggota($data)
    {
        $this->db->insert('tbl_anggota', $data);
    }

    

	//UPDATE anggota //

    function update_anggota($where, $data)
    {
        $this->db->where($where);
        $this->db->update("tbl_anggota", $data);
    }

    function hapus_anggota($id)
    {
        $this->db->delete('tbl_anggota', array('anggota_id' => $id));
    }

    //import anggota//

    public function upload_file($filename)
	{
		$this->load->library('upload'); // Load librari upload

		$config['upload_path'] = './csv/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;

		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
						// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		} else {
						// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
		
					// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data)
	{
		$this->db->insert_batch('tbl_anggota', $data);
	}


}