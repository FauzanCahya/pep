<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_menu_1($id_pegawai){
		$sql = "
		SELECT a.* FROM kepeg_menu_1 a 
		JOIN (
			SELECT ID_MENU FROM kepeg_hak_akses
			WHERE ID_PEGAWAI = '$id_pegawai' AND KET = 'MENU_PORTAL'
		) b ON a.ID = b.ID_MENU
        ORDER BY a.URUT ASC
		";

		return $this->db->query($sql)->result();
	}

	function get_menu_2($id_pegawai, $id_menu1){
		$sql = "
		SELECT a.* FROM kepeg_menu_2 a 
		JOIN (
			SELECT ID_MENU FROM kepeg_hak_akses
			WHERE ID_PEGAWAI = '$id_pegawai' AND KET = 'MENU_2'
		) b ON a.ID = b.ID_MENU
		WHERE a.ID_MENU_1 = '$id_menu1'
        ORDER BY a.URUT ASC
		";

		return $this->db->query($sql)->result();
	}

	function get_menu_3($id_pegawai, $id_menu2){
		$sql = "
		SELECT a.* FROM kepeg_menu_3 a 
		JOIN (
			SELECT ID_MENU FROM kepeg_hak_akses
			WHERE ID_PEGAWAI = '$id_pegawai' AND KET = 'MENU_3'
		) b ON a.ID = b.ID_MENU
		WHERE a.ID_MENU_2 = '$id_menu2'
        ORDER BY a.URUT ASC
		";

		return $this->db->query($sql)->result();
	}

}