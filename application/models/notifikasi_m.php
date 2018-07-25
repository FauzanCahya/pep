<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_notifikasi($kode_satuan_1,$kode_satuan_2,$nilai_1,$nilai_2)
	{
		// $sql = "
		// 	INSERT INTO master_notifikasi (
		// 		kode_satuan_1,
		// 		kode_satuan_2,
		// 		nilai_1,
		// 		nilai_2
		// 	) VALUES (
		// 		'$kode_satuan_1',
		// 		'$kode_satuan_2',
		// 		'$nilai_1',
		// 		'$nilai_2'
		// 	)";
		// $this->db->query($sql);
	}

	function lihat_data_notifikasi()
	{
		// $sql = "
		// 	SELECT * FROM master_notifikasi ";

		// return $this->db->query($sql)->result();
	}

	function hapus_notifikasi($id)
	{
		// $sql = "DELETE FROM  master_notifikasi WHERE id_notifikasi = '$id' " ;
		// $this->db->query($sql);
	}

	function data_notifikasi_id($id)
	{
		// $sql = "SELECT * FROM master_notifikasi WHERE id_notifikasi = '$id' ";
		// $query = $this->db->query($sql);
		// return $query->row();
	}

	function ubah_data_notifikasi($id,$id_satuan_1_modal,$id_satuan_2_modal,$nilai_1_modal,$nilai_2_modal)
	{
		// $sql = "
		// 	UPDATE master_notifikasi SET
		// 		kode_satuan_1  = '$id_satuan_1_modal',
		// 		kode_satuan_2  = '$id_satuan_2_modal',
		// 		nilai_1  	   = '$nilai_1_modal', 
		// 		nilai_2  	   = '$nilai_2_modal'
		// 	WHERE id_notifikasi = '$id'
		// ";
		// $this->db->query($sql);
	}
}
