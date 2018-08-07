<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_level_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_depart($nama_depart)
	{
		$sql = "
			INSERT INTO master_level (
				
				LEVEL
			) VALUES (
				
				'$nama_depart'
			)";
		$this->db->query($sql);
	}

	function lihat_data_depart()
	{
		$sql = "
			SELECT * FROM master_level ";

		return $this->db->query($sql)->result();
	}

	function hapus_depart($id)
	{
		$sql = "DELETE FROM  master_level WHERE ID = '$id' " ;
		$this->db->query($sql);
	}

	function data_depart_id($id)
	{
		$sql = "SELECT * FROM master_level WHERE ID = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_depart($id,$nama_depart_modal)
	{
		$sql = "
			UPDATE master_level SET
				LEVEL  = '$nama_depart_modal'
			WHERE ID = '$id'
		";
		$this->db->query($sql);
	}
}

