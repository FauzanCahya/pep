<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function tampil_no_spb($nomor){
		$sql = "SELECT * FROM tb_permintaan_barang WHERE no_spb = '$nomor'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_spb_di_opb($nomor){
		$sql = "
			SELECT 
				a.id,
				a.no_spb,
				b.no_opb,
				b.tanggal,
				b.uraian
			FROM tb_order_pembelian_detail a
			LEFT JOIN tb_order_pembelian b ON b.id_order = a.id_induk
			WHERE a.no_spb = '$nomor'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_opb_di_po($nomor){
		$sql = "
			SELECT 
				a.*,
				b.tanggal
			FROM tb_purchase_order_detail a
			LEFT JOIN tb_purchase_order b ON b.id_purchase = a.id_induk
			WHERE a.no_opb = '$nomor'
		";
		$query = $this->db->query($sql);
		return $query->row();
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
