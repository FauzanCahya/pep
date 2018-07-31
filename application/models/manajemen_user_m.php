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
			ORDER BY tb.id DESC
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

	function get_divisi($keyword){
		$where = "1 = 1";

		if($keyword != ""){
			$where = $where." AND nama_divisi LIKE '%$keyword%'";
		}else{
			$where = $where;
		}

		$sql = "SELECT * FROM master_divisi WHERE $where";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	function get_divisi_id($id){
		$sql = "SELECT * FROM master_divisi WHERE id_divisi = '$id'";
		$qry = $this->db->query($sql);
		return $qry->row();
	}

	function cek_username($username){
		$sql = "SELECT COUNT(*) AS TOTAL FROM tb_user WHERE username = '$username'";
		$qry = $this->db->query($sql);
		return $qry->row();
	}

	function simpan_user($username,$password,$nama_user,$departemen,$level){
		$sql = "
			INSERT INTO tb_user(
				username,
				password,
				nama_user,
				departemen,
				level
			) VALUES (
				'$username',
				'$password',
				'$nama_user',
				'$departemen',
				'$level'
			)
		";
		$this->db->query($sql);
	}

	function ubah_with_pass($id,$username,$password,$nama_user){
		$sql = "
			UPDATE tb_user SET
				username = '$username',
				password = '$password',
				nama_user = '$nama_user'
			WHERE id  = '$id'
		";
		$this->db->query($sql);
	}

	function ubah_no_pass($id,$username,$nama_user){
		$sql = "
			UPDATE tb_user SET
				username = '$username',
				nama_user = '$nama_user'
			WHERE id  = '$id'
		";
		$this->db->query($sql);
	}

	function hapus($id){
		$sql = "DELETE FROM tb_user WHERE id = '$id'";
		$this->db->query($sql);
	}

	function get_data_menu_1($id_pegawai){

		if($id_pegawai == ""){
			$sql = "
				SELECT a.*, 0 AS STS FROM kepeg_menu_1 a
				ORDER BY a.URUT ASC
			"; 
		} else {
			$sql = "
			SELECT a.ID, a.NAMA, a.LINK, a.ICON, a.URUT, IFNULL(a.STS, 0) AS STS FROM (
				SELECT a.ID, a.NAMA, a.LINK, a.ICON, a.URUT, IFNULL(a.STS, 0) AS STS FROM (
					SELECT a.*, IFNULL(b.ID_MENU, 0) AS STS FROM kepeg_menu_1 a 
					LEFT JOIN (
						SELECT ID_MENU FROM kepeg_hak_akses
						WHERE ID_PEGAWAI = $id_pegawai AND KET = 'MENU_PORTAL'
					) b ON a.ID = b.ID_MENU
				) a 				
			) a
            ORDER BY a.URUT ASC
			";
		}		

		return $this->db->query($sql)->result();
	}

	function get_data_menu_2($id_menu1, $id_pegawai){
		

		if($id_pegawai == ""){
			$sql = "
				SELECT a.*, 0 AS STS FROM kepeg_menu_2 a WHERE a.ID_MENU_1 = $id_menu1
				ORDER BY a.URUT ASC
				";
		} else {
			$sql = "
			SELECT a.ID, a.NAMA, a.LINK, a.ICON, a.URUT, IFNULL(a.STS, 0) AS STS FROM (
				SELECT a.ID, a.NAMA, a.LINK, a.ICON, a.URUT, IFNULL(a.STS, 0) AS STS FROM (
					SELECT a.*, IFNULL(b.ID_MENU, 0) AS STS FROM kepeg_menu_2 a 
					LEFT JOIN (
						SELECT ID_MENU FROM kepeg_hak_akses
						WHERE ID_PEGAWAI = $id_pegawai AND KET = 'MENU_2'
					) b ON a.ID = b.ID_MENU
					WHERE a.ID_MENU_1 = $id_menu1
				) a 				
			) a
            ORDER BY a.URUT ASC
			";
		}

		return $this->db->query($sql)->result();
	}

	function get_data_menu_3($id_menu2, $id_pegawai){
		

		if($id_pegawai == ""){
			$sql = "
			SELECT a.*, 0 AS STS FROM kepeg_menu_3 a WHERE a.ID_MENU_2 = $id_menu2
			ORDER BY a.URUT ASC
			";
		} else {
			$sql = "
			SELECT a.ID, a.NAMA, a.LINK, a.ICON, a.URUT, IFNULL(a.STS, 0) AS STS FROM (
				SELECT a.ID, a.NAMA, a.LINK, a.ICON, a.URUT, IFNULL(a.STS, 0) AS STS FROM (
					SELECT a.*, IFNULL(b.ID_MENU, 0) AS STS FROM kepeg_menu_3 a 
					LEFT JOIN (
						SELECT ID_MENU FROM kepeg_hak_akses
						WHERE ID_PEGAWAI = $id_pegawai AND KET = 'MENU_3'
					) b ON a.ID = b.ID_MENU
					WHERE a.ID_MENU_2 = $id_menu2
				) a 				
			) a
            ORDER BY a.URUT ASC
			";
		}

		return $this->db->query($sql)->result();
	}

	function simpan_hak_akses($id_user,$id_menu,$keterangan){
		$sql = "
			INSERT INTO kepeg_hak_akses(
				ID_PEGAWAI,
				ID_MENU,
				KET
			) VALUES(
				'$id_user',
				'$id_menu',
				'$keterangan'
			)
		";
		$this->db->query($sql);
	}

	function hapus_hak_akses($id_user){
		$sql = "DELETE FROM  kepeg_hak_akses WHERE ID_PEGAWAI = '$id_user' " ;
		$this->db->query($sql);
	}

}
