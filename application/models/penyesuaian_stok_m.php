<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penyesuaian_stok_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_opname($id_barang,$nama_barang,$qty_opname,$harga_opname,$ket_opname)
	{
		$tgl = date("d-m-Y");
		$sql = "
			INSERT INTO ak_stok_opname (
				TGL,
				ID_BARANG,
				QTY_OPNAME,
				HARGA_OPNAME,
				KETERANGAN
			) VALUES (
				'$tgl',
				'$id_barang',
				'$qty_opname',
				'$harga_opname',
				'$ket_opname'
			)";
		$this->db->query($sql);

		$sql_barang = "
			UPDATE master_barang SET 
				stok = '$qty_opname',
				harga_jual	= '$harga_opname'
			WHERE id_barang = '$id_barang'
		";
		$this->db->query($sql_barang);
	}

	function lihat_data_barang()
	{
		$sql = "
			SELECT * FROM master_barang ORDER BY id_barang DESC";

		return $this->db->query($sql)->result();
	}

	function lihat_data_akun(){
		$sql = "
			SELECT * FROM ak_kode_akuntansi";

		return $this->db->query($sql)->result();
	}

	function hapus_pelanggan($id)
	{
		$sql = "DELETE FROM  master_pelanggan WHERE id_pelanggan = '$id' " ;
		$this->db->query($sql);
	}

	function barang_id($id)
	{
		$sql = "SELECT * FROM master_barang WHERE id_barang = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function save_akuntansi($kode_akun, $debet, $kredit, $keterangan){
		$debet    = str_replace(',', '', $debet);
		$kredit    = str_replace(',', '', $kredit);
		$tgl = date("d-m-Y");

		$sql = "
		INSERT INTO ak_input_voucher_lainnya 
		(KODE_AKUN, DEBET, KREDIT, TGL, KETERANGAN)
		VALUES 
		('$kode_akun', '$debet', '$kredit', '$tgl', '$keterangan')
		";

		$this->db->query($sql);
	}
}
