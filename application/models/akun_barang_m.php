<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun_barang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_barang($kode_barang,$nama_barang,$alamat_barang,$telp,$email,$npwp)
	{
		$sql = "
			INSERT INTO master_barang (
				kode_barang,
				nama_barang,
				alamat_barang,
				telp,
				email,
				npwp
			) VALUES (
				'$kode_barang',
				'$nama_barang',
				'$alamat_barang',
				'$telp',
				'$email',
				'$npwp'
			)";
		$this->db->query($sql);
	}

	function lihat_data_barang_edit($id)
	{
		$sql = "
			SELECT * FROM master_barang WHERE id_barang = '$id' ";

		return $this->db->query($sql)->row();
	}

	function lihat_data_barang()
	{
		$sql = "
			SELECT * FROM master_barang ";

		return $this->db->query($sql)->result();
	}

	function hapus_barang($id)
	{
		$sql = "DELETE FROM  master_barang WHERE id_barang = '$id' " ;
		$this->db->query($sql);
	}

	function data_barang_id($id)
	{
		$sql = "SELECT * FROM master_barang WHERE id_barang = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_barang($id,$kode_barang_modal,$nama_barang_modal,$alamat_barang_modal,$telp_modal,$email_modal,$npwp_modal)
	{
		$sql = "
			UPDATE master_barang SET
				kode_barang 	 = '$kode_barang_modal',
				nama_barang  	 = '$nama_barang_modal',
				alamat_barang  = '$alamat_barang_modal',
				telp  			 = '$telp_modal',
				email 			 = '$email_modal',
				npwp  			 = '$npwp_modal'
			WHERE id_barang = '$id'
		";
		$this->db->query($sql);
	}

	function simpan_data_barang_akun($id,$nama,$akun_debit,$akun_kredit)
	{
		$sql = "
			UPDATE master_barang SET
				akun_debit 	 	 = '$akun_debit',
				akun_kredit  	 = '$akun_kredit'
			WHERE kode_barang = '$id'
		";
		$this->db->query($sql);
	}
}
