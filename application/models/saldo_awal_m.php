<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saldo_awal_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_saldoawal($kode_akun,$debet,$kredit)
	{
		$sql = "
			INSERT INTO ak_saldo_awal (
				KODE_AKUN,
				DEBET,
				KREDIT
			) VALUES (
				'$kode_akun',
				'$debet',
				'$kredit'
			)";
		$this->db->query($sql);
	}

	function lihat_data_saldo_awal()
	{
		$sql = "
			SELECT * FROM ak_saldo_awal ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_kode_akun(){
		$sql = "
			SELECT * FROM ak_kode_akuntansi WHERE KODE_AKUN NOT IN (SELECT KODE_AKUN FROM ak_saldo_awal)
		";

		return $this->db->query($sql)->result();
	}

	function hapus_pelanggan($id)
	{
		$sql = "DELETE FROM  ak_saldo_awal WHERE ID = '$id' " ;
		$this->db->query($sql);
	}

	function data_saldo_awal_id($id)
	{
		$sql = "SELECT * FROM ak_saldo_awal WHERE ID = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_saldo_awal($id_saldo_awal, $ed_debet, $ed_kredit)
	{
		$sql = "
			UPDATE ak_saldo_awal SET
				DEBET 	 = '$ed_debet',
				KREDIT   = '$ed_kredit'
			WHERE ID = '$id_saldo_awal'
		";
		$this->db->query($sql);
	}
}
