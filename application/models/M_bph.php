<?php
class M_bph extends CI_Model
{

    function get_all_bph()
    {
        $hsl = $this->db->get('tbl_bph');
        return $hsl;
    }

    function get_all_bphById($id)
    {
        $hsl = $this->db->get('tbl_bph', $id);
        return $hsl;
    }

    function simpan_bph($data)
    {
        $this->db->insert('tbl_bph', $data);
    }



    //UPDATE Bph //

    function update_bph($where, $data)
    {
        $this->db->where($where);
        $this->db->update("tbl_bph", $data);
    }
    function hapus_gambar($where)
    {
        $hsl = $this->db->query("DELETE FROM tbl_bph(bph_photo) WHERE bph_id='$where'");
        return $hsl;
    }


    //END UPDATE Bph//

    function hapus_bph($id)
    {
        $this->db->delete('tbl_bph', array('bph_id' => $id));
    }
}
