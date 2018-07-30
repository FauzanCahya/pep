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
	

}
