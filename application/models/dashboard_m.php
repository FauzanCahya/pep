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
			$where = $where." AND no_spb LIKE '%$sie%'";
		}else{
			$where = $where;
		}

		if($tahun != ""){
			$where = $where." AND SUBSTR(tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT 
				*,
				SUBSTR(tanggal,7) AS tahun
			FROM tb_permintaan_barang 
			WHERE $where
			AND no_spb LIKE '%$nomor%'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_spb_di_opb($nomor,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND a.no_spb LIKE '%$sie%'";
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
				b.uraian
			FROM tb_order_pembelian_detail a
			LEFT JOIN tb_order_pembelian b ON b.id_order = a.id_induk
			WHERE $where
			AND a.no_spb LIKE '%$nomor%'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_opb_di_po($nomor,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND a.no_opb LIKE '%$sie%'";
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
			AND a.no_opb LIKE '%$nomor%'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_lpb($nomor,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND a.no_po LIKE '%$sie%'";
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
				b.no_lpb,
				b.tanggal
			FROM tb_laporan_penerimaan_detail a
			LEFT JOIN tb_laporan_penerimaan b ON b.id_laporan = a.id_induk
			WHERE $where
			AND a.no_po = '$nomor'
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
				b.uraian
			FROM tb_order_pembelian_detail a
			LEFT JOIN tb_order_pembelian b ON b.id_order = a.id_induk
			WHERE $where
			AND b.no_opb LIKE '%$nomor%'
			GROUP BY a.id
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_spb_dr_first_opb($no_opb,$sie,$tahun){
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
				b.uraian
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

		if($sie != ""){
			$where = $where." AND a.no_po LIKE '%$sie%'";
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

	function tampil_no_opb_by_po($no_po,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND PO.no_po LIKE '%$sie%'";
		}else{
			$where = $where;
		}

		if($tahun != ""){
			$where = $where." AND SUBSTR(OPB.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT
				OPB.*,
				OPB_DET.keterangan,
				PO.no_po
			FROM tb_order_pembelian OPB
			LEFT JOIN tb_order_pembelian_detail OPB_DET ON OPB_DET.id_induk = OPB.id_order
			LEFT JOIN tb_purchase_order_detail PO_DET ON PO_DET.no_opb = OPB.no_opb
			LEFT JOIN tb_purchase_order PO ON PO.id_purchase = PO_DET.id_induk
			WHERE $where
			AND PO.no_po = '$no_po'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function tampil_no_spb_by_opb($no_opb,$sie,$tahun){
		$where = "1 = 1";

		if($sie != ""){
			$where = $where." AND OPB.no_opb LIKE '%$sie%'";
		}else{
			$where = $where;
		}

		if($tahun != ""){
			$where = $where." AND SUBSTR(OPB.tanggal,7) = '$tahun'";
		}else{
			$where = $where;
		}

		$sql = "
			SELECT
				OPB.*,
				OPB_DET.no_spb
			FROM tb_order_pembelian OPB
			LEFT JOIN tb_order_pembelian_detail OPB_DET ON OPB_DET.id_induk = OPB.id_order
			WHERE OPB.no_opb = '$no_opb'
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
				LPB_DET.no_po
			FROM tb_laporan_penerimaan LPB
			LEFT JOIN tb_laporan_penerimaan_detail LPB_DET ON LPB_DET.id_induk = LPB.id_laporan
			WHERE $where
			AND LPB.no_lpb LIKE '%$nomor%'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}
	

}
