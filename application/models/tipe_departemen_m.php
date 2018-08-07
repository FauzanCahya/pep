<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipe_departemen_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_depart($nama_depart)
	{
		$sql = "
			INSERT INTO master_tipe_departemen (
				
				NAMA_DEPARTEMEN
			) VALUES (
				
				'$nama_depart'
			)";
		$this->db->query($sql);
	}

	function lihat_data_depart()
	{
		$sql = "
			SELECT * FROM master_tipe_departemen ";

		return $this->db->query($sql)->result();
	}

	function hapus_depart($id)
	{
		$sql = "DELETE FROM  master_tipe_departemen WHERE ID = '$id' " ;
		$this->db->query($sql);
	}

	function data_depart_id($id)
	{
		$sql = "SELECT * FROM master_tipe_departemen WHERE ID = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_depart($id,$nama_depart_modal)
	{
		$sql = "
			UPDATE master_tipe_departemen SET
				NAMA_DEPARTEMEN  = '$nama_depart_modal'
			WHERE ID = '$id'
		";
		$this->db->query($sql);
	}
}
