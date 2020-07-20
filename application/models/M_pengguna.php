<?php
class M_pengguna extends CI_Model
{

	function get_all_pengguna()
	{
		$hsl = $this->db->query("SELECT tbl_pengguna.*,IF(pengguna_jenkel='L','Laki-Laki','Perempuan') AS jenkel FROM tbl_pengguna");
		return $hsl;
	}
	function simpan_pengguna($data)
	{
		$this->db->insert('tbl_pengguna', $data);
	}
	function simpan_pengguna_tanpa_gambar($data)
	{
		$this->db->insert('tbl_pengguna', $data);
	}


	//UPDATE PENGGUNA //

	function update_pengguna($where, $data)
	{
		$this->db->where($where);
		$this->db->update('tbl_pengguna', $data);
	}

	function update_pengguna_tanpa_gambar($where, $data)
	{
		$this->db->where($where);
		$this->db->update('tbl_pengguna', $data);
	}
	//END UPDATE PENGGUNA//

	function hapus_pengguna($id)
	{
		$this->db->delete('tbl_pengguna', array('pengguna_id' => $id));
	}
	function getusername($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_pengguna where pengguna_id='$id'");
		return $hsl;
	}
	function resetpass($id, $pass)
	{
		$hsl = $this->db->query("UPDATE tbl_pengguna set pengguna_password=md5('$pass') where pengguna_id='$id'");
		return $hsl;
	}

	function get_pengguna_login($kode)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_pengguna where pengguna_id='$kode'");
		return $hsl;
	}


}