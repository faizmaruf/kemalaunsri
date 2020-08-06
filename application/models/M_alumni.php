<?php
class M_alumni extends CI_Model
{

    function get_all_alumni()
    {
        $hsl = $this->db->get('tbl_alumni');
        return $hsl;
    }

    function get_all_alumniById($id)
    {
        $hsl = $this->db->get('tbl_alumni', $id);
        return $hsl;
    }

    function simpan_alumni($data)
    {
        $this->db->insert('tbl_alumni', $data);
    }
    function jumlah_alumni()
    {
        $query = $this->db->query("SELECT * FROM tbl_alumni");
        $jum = $query->num_rows();
        return $jum;
    }



    //UPDATE alumni //

    function update_alumni($where, $data)
    {
        $this->db->where($where);
        $this->db->update("tbl_alumni", $data);
    }

    function hapus_alumni($id)
    {
        $this->db->delete('tbl_alumni', array('alumni_id' => $id));
    }

    //import alumni//

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
        $this->db->insert_batch('tbl_alumni', $data);
    }
}
