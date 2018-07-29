<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manajemen_user_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_user(){
		$sql = "
			SELECT 
				tb.*, 
				md.nama_divisi as nama_departemen 
			FROM tb_user tb, 
			master_divisi md 
			WHERE tb.departemen = md.id_divisi
		";

		return $this->db->query($sql)->result();
	}

	function get_user_id($id){
		$sql = "
			SELECT 
				tb.*, 
				md.nama_divisi as nama_departemen 
			FROM tb_user tb
			LEFT JOIN master_divisi md ON tb.departemen = md.id_divisi
			WHERE tb.id = '$id'
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function menu_lev_1(){
		$sql = "SELECT * FROM menu_lev_1 WHERE STATUS  = '1' ORDER BY URUT ASC";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	function menu_lev_1_id($id){
		$sql = "SELECT * FROM menu_lev_1 WHERE ID = '$id' AND STATUS  = '1' ORDER BY URUT ASC";
		$qry = $this->db->query($sql);
		return $qry->row();
	}

	function menu_lev_2($id_menu_lev_1){
		$sql = "
			SELECT 
				ID,
				MASTER_DATA,
				MENU_LEV AS MENU_LEV2,
				LINK AS LINK_LEV2
			FROM menu_lev_2 
			WHERE ID_MENU_LEV_1 = '$id_menu_lev_1'
			AND STATUS = '1'
			ORDER BY URUT ASC
		";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	function simpan($id_user,$id_menu_lev_1,$id_menu_lev_2){
		$sql = "
			INSERT INTO menu_hak_akses(
				ID_USER,
				ID_MENU_LEV_1,
				ID_MENU_LEV_2,
				STATUS
			) VALUES(
				'$id_user',
				'$id_menu_lev_1',
				'$id_menu_lev_2',
				'1'
			)
		";
		$this->db->query($sql);
	}

	function ubah($id_user,$id_menu_lev_1){
		$sql = "
			UPDATE menu_hak_akses SET
				ID_MENU_LEV_1  = '$id_menu_lev_1'
			WHERE ID_USER  = '$id_user'
		";
		$this->db->query($sql);
	}

	function hapus($id_user){
		$sql = "DELETE FROM  menu_hak_akses WHERE ID_USER = '$id_user' " ;
		$this->db->query($sql);
	}

}
