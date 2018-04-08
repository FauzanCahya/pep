<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_management_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_user_management($username,$password,$departemen,$nama_user,$level)
	{
		$sql = "
			INSERT INTO tb_user (
				username,
				password,
				departemen,
				nama_user,
				level
			) VALUES (
				'$username',
				'$password',
				'$departemen',
				'$nama_user',
				'$level'
			)";
		$this->db->query($sql);
	}

	function lihat_data_user_management()
	{
		$sql = "
			SELECT * FROM tb_user ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_nama_user()
	{
		$sql = "
			SELECT * FROM tb_user ";

		return $this->db->query($sql)->result();
	}

	function hapus_user_management($id)
	{
		$sql = "DELETE FROM  tb_user WHERE id = '$id' " ;
		$this->db->query($sql);
	}

	function data_user_management_id($id)
	{
		$sql = "SELECT * FROM tb_user WHERE id = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_user_management($id,$username_modal,$password_modal)
	{
		$sql = "
			UPDATE tb_user SET
				username  = '$username_modal',
				password  = '$password_modal'
			WHERE id = '$id'
		";
		$this->db->query($sql);
	}
}
