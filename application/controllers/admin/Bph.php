<?php
class Bph extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['logged_in'])) {
            $url = base_url('administrator');
            redirect($url);
        };
        $this->load->model('m_bph');
        $this->load->library('upload');
    }


    function index()
    {
        $x['data'] = $this->m_bph->get_all_bph();
        $x['judul'] = 'Kemala | Bph';
        $this->load->view('admin/v_bph', $x);
    }

    function simpan_bph()
    {
        $config['upload_path'] = './assets/images/bph/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = true; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/images/bph/' . $gbr['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = false;
                $config['quality'] = '90%';
                $config['width'] = 360;
                $config['height'] = 240;
                $config['new_image'] = './assets/images/bph/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                $nama = $this->input->post('xnama');
                $nim = $this->input->post('xnim');
                $angkatan = $this->input->post('xangkatan');
                $jabatan = $this->input->post('xjabatan');
                $jenkel = $this->input->post('xjenkel');
                $fakultas = $this->input->post('xfakultas');
                $instagram = $this->input->post('xinstagram');
                $facebook = $this->input->post('xfacebook');

                $data = array(
                    'bph_nama' => $nama,
                    'bph_nim' => $nim,
                    'bph_angkatan' => $angkatan,
                    'bph_jabatan' => $jabatan,
                    'bph_jenkel' => $jenkel,
                    'bph_fakultas' => $fakultas,
                    'bph_facebook' => $facebook,
                    'bph_instagram' => $instagram,
                    'bph_photo' => $gambar
                );

                $this->m_bph->simpan_bph($data);
                echo $this->session->set_flashdata('msg', 'success');
                redirect('admin/bph');
            } else {
                echo $this->session->set_flashdata('msg', 'warning');
                redirect('admin/bph');
            }
        } else {
            $nama = $this->input->post('xnama');
            $nim = $this->input->post('xnim');
            $angkatan = $this->input->post('xangkatan');
            $jabatan = $this->input->post('xjabatan');
            $jenkel = $this->input->post('xjenkel');
            $fakultas = $this->input->post('xfakultas');
            $instagram = $this->input->post('xinstagram');
            $facebook = $this->input->post('xfacebook');
            $data = array(
                'bph_nama' => $nama,
                'bph_nim' => $nim,
                'bph_angkatan' => $angkatan,
                'bph_jabatan' => $jabatan,
                'bph_jenkel' => $jenkel,
                'bph_fakultas' => $fakultas,
                'bph_facebook' => $facebook,
                'bph_instagram' => $instagram,
            );

            $this->m_bph->simpan_bph($data);
            echo $this->session->set_flashdata('msg', 'success');
            redirect('admin/bph');
        }
    }

    function update()
    {
        $config['upload_path'] = './assets/images/bph/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = true; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/images/bph/' . $gbr['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = false;
                $config['quality'] = '90%';
                $config['width'] = 360;
                $config['height'] = 240;
                $config['new_image'] = './assets/images/bph/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                $nama = $this->input->post('xnama');
                $nim = $this->input->post('xnim');
                $angkatan = $this->input->post('xangkatan');
                $jabatan = $this->input->post('xjabatan');
                $jenkel = $this->input->post('xjenkel');
                $fakultas = $this->input->post('xfakultas');
                $instagram = $this->input->post('xinstagram');
                $facebook = $this->input->post('xfacebook');
                $id = $this->input->post('xid');
                $where = array('bph_id' => $id);

                $data = array(
                    'bph_id' => $id,
                    'bph_nama' => $nama,
                    'bph_nim' => $nim,
                    'bph_angkatan' => $angkatan,
                    'bph_jabatan' => $jabatan,
                    'bph_jenkel' => $jenkel,
                    'bph_fakultas' => $fakultas,
                    'bph_facebook' => $facebook,
                    'bph_instagram' => $instagram,
                    'bph_photo' => $gambar
                );


                $this->m_bph->update_bph($where, $data);
                echo $this->session->set_flashdata('msg', 'info');
                redirect('admin/bph');
            } else {
                echo $this->session->set_flashdata('msg', 'warning');
                redirect('admin/bph');
            }
        }
    }

    function hapus_bph()
    {
        $id = $this->input->post('xid');
        $data = $this->m_bph->get_all_bphById($id);
        $q = $data->row_array();
        $p = $q['bph_photo'];
        $path =  './assets/images/bph/' . $p;
        unlink($path);
        $this->m_bph->hapus_bph($id);
        echo $this->session->set_flashdata('msg', 'success-hapus');
        redirect('admin/bph');
    }
}
