<?php
class M_coverpage extends CI_Model
{

	function get_all_coverpage()
	{
		$hsl = $this->db->query("SELECT tbl_coverpage.*,DATE_FORMAT(coverpage_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_coverpage");
		//$hsl = $this->db->get('tbl_coverpage');
		return $hsl;
	}
	function simpan_coverpage($judul, $gambar)
	{
		$this->db->trans_start();
		$this->db->query("insert into tbl_coverpage(coverpage_judul,coverpage_gambar) values ('$judul','$gambar')");

		$this->db->trans_complete();
		if ($this->db->trans_status() == true)
			return true;
		else
			return false;
	}

	function update_coverpage($coverpage_id, $judul, $gambar)
	{
		$hsl = $this->db->query("update tbl_coverpage set coverpage_judul='$judul',coverpage_gambar='$gambar' where coverpage_id='$coverpage_id'");
		return $hsl;
	}
	function update_coverpage_tanpa_img($coverpage_id, $judul, $user_nama)
	{
		$hsl = $this->db->query("update tbl_coverpage set coverpage_judul='$judul' where coverpage_id='$coverpage_id'");
		return $hsl;
	}
	function hapus_coverpage($kode)
	{
		$this->db->trans_start();
		$this->db->query("delete from tbl_coverpage where coverpage_id='$kode'");
		$this->db->trans_complete();
		if ($this->db->trans_status() == true)
			return true;
		else
			return false;
	}
}
