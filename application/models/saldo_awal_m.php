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

	function ubah_data_pelanggan($id,$kode_pelanggan_modal,$nama_pelanggan_modal,$alamat_pelanggan_modal,$telp_modal,$email_modal,$npwp_modal)
	{
		$sql = "
			UPDATE master_pelanggan SET
				kode_pelanggan 	 = '$kode_pelanggan_modal',
				nama_pelanggan   = '$nama_pelanggan_modal',
				alamat_pelanggan = '$alamat_pelanggan_modal',
				telp  			 = '$telp_modal',
				email 			 = '$email_modal',
				npwp  			 = '$npwp_modal'
			WHERE id_pelanggan = '$id'
		";
		$this->db->query($sql);
	}
}
