<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function tampil_no_spb($nomor,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND SPB.no_spb LIKE '%$sie%'";
		}else{
			$where = $where;
		}

		if($tahun != ""){
			$where = $where." AND SUBSTR(SPB.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT 
				SPB.*,
				SUBSTR(SPB.tanggal,7) AS tahun,
				SPB_DET.nama_produk
			FROM tb_permintaan_barang SPB
			LEFT JOIN tb_permintaan_barang_detail SPB_DET ON SPB_DET.id_induk = SPB.id_permintaan
			WHERE $where
			AND SPB.no_spb LIKE '%$nomor%'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_spb_di_opb($no_spb,$sie,$tahun){
		$where = "1 = 1";

		if($tahun != ""){
			$where = $where." AND SUBSTR(b.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT 
				a.id,
				a.no_spb,
				a.nama_produk,
				b.no_opb,
				b.tanggal,
				b.uraian
			FROM tb_order_pembelian_detail a
			LEFT JOIN tb_order_pembelian b ON b.id_order = a.id_induk
			WHERE $where
			AND a.no_spb = '$no_spb'
			ORDER BY b.id_order ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_opb_di_po($no_opb,$sie,$tahun){
		$where = "1 = 1";

		if($tahun != ""){
			$where = $where." AND SUBSTR(b.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT 
				a.*,
				b.no_po,
				b.tanggal
			FROM tb_purchase_order_detail a
			LEFT JOIN tb_purchase_order b ON b.id_purchase = a.id_induk
			WHERE $where
			AND a.no_opb = '$no_opb'
			ORDER BY a.id ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_lpb($no_po,$sie,$tahun){
		$where = "1 = 1";

		if($tahun != ""){
			$where = $where." AND SUBSTR(b.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT
				a.*,
				b.no_lpb,
				b.tanggal
			FROM tb_laporan_penerimaan_detail a
			LEFT JOIN tb_laporan_penerimaan b ON b.id_laporan = a.id_induk
			WHERE $where
			AND a.no_po = '$no_po'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_opb_first($nomor,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND b.no_opb LIKE '%$sie%'";
		}else{
			$where = $where;
		}

		if($tahun != ""){
			$where = $where." AND SUBSTR(b.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT 
				a.id,
				a.no_spb,
				b.no_opb,
				b.tanggal,
				b.uraian,
				a.nama_produk
			FROM tb_order_pembelian b
			LEFT JOIN tb_order_pembelian_detail a ON b.id_order = a.id_induk
			WHERE $where
			AND b.no_opb LIKE '%$nomor%'
			GROUP BY a.id
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_spb_dr_first_opb($no_opb,$sie,$tahun){
		$where = "1 = 1";

		if($tahun != ""){
			$where = $where." AND SUBSTR(b.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT 
				a.id,
				a.no_spb,
				b.no_opb,
				b.tanggal,
				b.uraian,
				a.nama_produk
			FROM tb_order_pembelian_detail a
			LEFT JOIN tb_order_pembelian b ON b.id_order = a.id_induk
			WHERE $where
			AND b.no_opb LIKE '%$no_opb%'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_po_first($nomor,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND b.no_po LIKE '%$sie%'";
		}else{
			$where = $where;
		}

		if($tahun != ""){
			$where = $where." AND SUBSTR(b.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT 
				a.*,
				b.no_po,
				b.tanggal
			FROM tb_purchase_order_detail a
			LEFT JOIN tb_purchase_order b ON b.id_purchase = a.id_induk
			WHERE $where
			AND b.no_po LIKE '%$nomor%'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_lpb_dr_po($no_po,$sie,$tahun){
		$where = "1 = 1";

		if($tahun != ""){
			$where = $where." AND SUBSTR(b.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT
				a.*,
				b.no_lpb,
				b.tanggal
			FROM tb_laporan_penerimaan_detail a
			LEFT JOIN tb_laporan_penerimaan b ON b.id_laporan = a.id_induk
			WHERE $where
			AND a.no_po = '$no_po'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_opb_by_po($no_opb,$sie,$tahun){
		$where = "1 = 1";

		if($tahun != ""){
			$where = $where." AND SUBSTR(OPB.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT
				OPB.*,
				OPB_DET.nama_produk,
				OPB_DET.no_spb
			FROM tb_order_pembelian OPB
			LEFT JOIN tb_order_pembelian_detail OPB_DET ON OPB_DET.id_induk = OPB.id_order
			WHERE $where
			AND OPB.no_opb = '$no_opb'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_spb_by_opb($no_spb,$sie,$tahun){
		$where = "1 = 1";

		if($tahun != ""){
			$where = $where." AND SUBSTR(SPB.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT
				SPB.*,
				SPB_DET.nama_produk
			FROM tb_permintaan_barang SPB
			LEFT JOIN tb_permintaan_barang_detail SPB_DET ON SPB_DET.id_induk = SPB.id_permintaan
			WHERE SPB.no_spb = '$no_spb'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_lpb_first($nomor,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND LPB.no_lpb LIKE '%$sie%'";
		}else{
			$where = $where;
		}

		if($tahun != ""){
			$where = $where." AND SUBSTR(LPB.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT
				LPB.*,
				LPB_DET.no_po,
				LPB_DET.nama_produk
			FROM tb_laporan_penerimaan LPB
			LEFT JOIN tb_laporan_penerimaan_detail LPB_DET ON LPB_DET.id_induk = LPB.id_laporan
			WHERE $where
			AND LPB.no_lpb LIKE '%$nomor%'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}
	

}
