<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_penerimaan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_laporan($no_lpb,$tanggal,$no_po,$diterima,$divisi)
	{
		$sql = "
			INSERT INTO tb_laporan_penerimaan (
				no_lpb,
				tanggal,
				no_po,
				diterima,
				status,
				divisi
			) VALUES (
				'$no_lpb',
				'$tanggal',
				'$no_po',
				'$diterima',
				'0',
				'$divisi'
			)";
		$this->db->query($sql);
	}

	function simpan_data_laporan_detail($id_laporan_baru,$id_produk,$nama_produk,$keterangan,$kuantitas,$no_opb)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$total 		= str_replace(',', '', $total);

		$sql = "
			INSERT INTO tb_laporan_penerimaan_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				no_po,
				pengambilan
			)	VALUES (
				'$id_laporan_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$no_opb',
				'0'
		)";
		$this->db->query($sql);
	}

	function lihat_data_laporan()
	{
		$sql = "
			SELECT * FROM tb_laporan_penerimaan ORDER BY id_laporan DESC ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_divisi()
	{
		$sql = "
			SELECT * FROM master_divisi ";

		return $this->db->query($sql)->result();
	}


	function hapus_laporan($id)
	{
		$sql = "UPDATE tb_laporan_penerimaan SET status = '1' WHERE id_laporan = '$id' " ;
		$this->db->query($sql);
		
		// $sql = "DELETE FROM  tb_laporan_penerimaan WHERE id_laporan = '$id' " ;
		// $this->db->query($sql);
	}

	function data_laporan_id($id)
	{
		$sql = "SELECT * FROM tb_laporan_penerimaan WHERE id_laporan = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_laporan($id,$no_lpb,$tanggal,$no_po,$diterima)
	{
		$sql = "
			UPDATE tb_laporan_penerimaan SET
				no_lpb  	  = '$no_lpb',
				tanggal 	  = '$tanggal',
				no_po  		  = '$no_po',
				diterima  	  = '$diterima'
			WHERE id_laporan  = '$id'
		";
		$this->db->query($sql);
	}

	function update_penerimaan_po($kuantitas,$id)
	{

		$kuantitas 	= str_replace(',', '', $kuantitas);

		$sql = "
			UPDATE tb_purchase_order_detail SET
				penerimaan  	  = penerimaan + $kuantitas
			WHERE id  = '$id'
		";
		$this->db->query($sql);
	}

	function tambah_stok_barang($kuantitas,$id)
	{

		$kuantitas 	= str_replace(',', '', $kuantitas);

		$sql = "
			UPDATE master_barang SET
				stok  	  = stok + $kuantitas
			WHERE id_barang  = '$id'
		";
		$this->db->query($sql);
	}

	function ubah_data_laporan_detail($id,$id_produk,$nama_produk,$keterangan,$kuantitas,$harga,$total,$no_opb)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$total 		= str_replace(',', '', $total);
		
		$sql = "
			UPDATE tb_laporan_penerimaan_detail SET
				id_produk 	  = '$id_produk',
				nama_produk   = '$nama_produk',
				keterangan    = '$keterangan',
				kuantitas  	  = '$kuantitas',
				harga  	  	  = '$harga',
				total  	  	  = '$total',
				no_opb  	  = '$no_opb'
			WHERE id_laporan  = '$id'
		";
		$this->db->query($sql);
	}

	function get_po_detail($id_purchase)
	{
		$sql = "SELECT * FROM tb_purchase_order WHERE id_purchase = $id_purchase";

		return $this->db->query($sql)->row();
	}

	function get_produk_detail($id_barang){
		
        $sql = " SELECT * FROM master_barang WHERE id_barang = $id_barang  ";

        return $this->db->query($sql)->row();
    }

    function get_transaction_info($id_barang){
        $sql = "
        SELECT pbd.id as id_peminjaman_detail, pbd.nama_produk , pb.no_po , pbd.kuantitas , pbd.penerimaan , pbd.harga , pbd.id_produk , pb.supplier ,(pbd.kuantitas - pbd.penerimaan) as sisain FROM tb_purchase_order pb , tb_purchase_order_detail pbd WHERE pb.id_purchase = pbd.id_induk AND pb.divisi = '$id_barang' AND pb.status = '0' AND pbd.penerimaan < pbd.kuantitas
        ";

        return $this->db->query($sql)->result();
    }

    function get_transaction_info_search($no_po,$id_barang){
        $sql = "
        SELECT pbd.id as id_peminjaman_detail, pbd.nama_produk , pb.no_po , pbd.kuantitas , pbd.penerimaan , pbd.harga , pbd.id_produk , pb.supplier ,(pbd.kuantitas - pbd.penerimaan) as sisain FROM tb_purchase_order pb , tb_purchase_order_detail pbd WHERE pb.id_purchase = pbd.id_induk AND pb.divisi = '$id_barang' AND pb.status = '0' AND pbd.penerimaan < pbd.kuantitas AND pb.no_po LIKE '%$no_po%'
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trx($id){
    	$sql = "
        SELECT * FROM tb_laporan_penerimaan WHERE id_laporan = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT lp.* , mb.nama_satuan , mb.kode_barang FROM tb_laporan_penerimaan_detail lp , master_barang mb WHERE mb.id_barang = lp.id_produk AND lp.id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
