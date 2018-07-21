<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_kat_barang(){
		$sql = "SELECT * FROM master_kategori_barang ORDER BY id_kategori ASC";
		return $this->db->query($sql)->result();
	}

	function get_kat_barang_id($id){
		$sql = "
			SELECT
				a.id_kategori,
				a.kode_kategori,
				a.nama_kategori,
				a.kode_akun_terima,
				a.kode_akun_pakai,
				a.kode_akun_hutang,
				b.NAMA_AKUN AS akun_terima,
				c.NAMA_AKUN AS akun_pakai,
				d.NAMA_AKUN AS akun_hutang
			FROM master_kategori_barang a
			LEFT JOIN ak_kode_akuntansi b ON a.kode_akun_terima = b.KODE_AKUN
			LEFT JOIN ak_kode_akuntansi c ON a.kode_akun_pakai = c.KODE_AKUN
			LEFT JOIN ak_kode_akuntansi d ON a.kode_akun_hutang = d.KODE_AKUN
			WHERE a.id_kategori = '$id';
		";
		return $this->db->query($sql)->row();
	}

	function get_kode_akun(){
		$sql = "SELECT * FROM ak_kode_akuntansi ORDER BY ID ASC";
		return $this->db->query($sql)->result();
	}

	function simpan_kode_akun($id_kategori,$field,$kode_akun){
		$sql = "UPDATE master_kategori_barang SET $field = '$kode_akun' WHERE id_kategori = '$id_kategori'";
		$this->db->query($sql);
	}

	function get_konsumen(){
		$sql = "SELECT * FROM master_pelanggan ORDER BY id_pelanggan ASC";
		return $this->db->query($sql)->result();
	}

	function get_konsumen_id($id){
		$sql = "
			SELECT
				a.*,
				b.NAMA_AKUN AS akun_hutang,
				c.NAMA_AKUN AS akun_piutang
			FROM master_pelanggan a
			LEFT JOIN ak_kode_akuntansi b ON b.KODE_AKUN = a.akun_hutang_dagang
			LEFT JOIN ak_kode_akuntansi c ON c.KODE_AKUN = a.akun_piutang_barang
			WHERE a.id_pelanggan = '$id'
		";
		return $this->db->query($sql)->row();
	}

	function simpan_kode_akun_kon($id_konsumen,$field,$kode_akun){
		$sql = "UPDATE master_pelanggan SET $field = '$kode_akun' WHERE id_pelanggan = '$id_konsumen'";
		$this->db->query($sql);
	}

}
