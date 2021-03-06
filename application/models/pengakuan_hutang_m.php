<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengakuan_hutang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_kode_akun($kode_akun,$nama_akun,$tipe,$kategori,$deskripsi,$level,$anak_dari,
								   $id_klien,$approve,$user_input,$tgl_input,$kode_grup,$kode_sub,$unit)
	{
		$sql = "
			INSERT INTO ak_kode_akuntansi (
				KODE_AKUN,
				NAMA_AKUN,
				TIPE,
				KATEGORI,
				DESKRIPSI,
				LEVEL,
				ANAK_DARI,
				ID_KLIEN,
				APPROVE,
				USER_INPUT,
				TGL_INPUT,
				KODE_GRUP,
				KODE_SUB,
				UNIT
			) VALUES (
				'$kode_akun',
				'$nama_akun',
				'$tipe',
				'$kategori',
				'$deskripsi',
				'$level',
				'$anak_dari',
				'$id_klien',
				'$approve',
				'$user_input',
				'$tgl_input',
				'$kode_grup',
				'$kode_sub',
				'$unit'
			)";
		$this->db->query($sql);
	}

	function save_akuntansi($no_bukti, $tgl, $kode_akun, $debet, $kredit, $keterangan){
		$debet = str_replace(',', '', $debet);
		$kredit = str_replace(',', '', $kredit);
		$keterangan = addslashes($keterangan);

		$sql = "
		INSERT INTO ak_input_voucher_lainnya
		(NO_BUKTI, KODE_AKUN, DEBET, KREDIT, TGL, KETERANGAN)
		VALUES 
		('$no_bukti', '$kode_akun', '$debet', '$kredit', '$tgl', '$keterangan')
		";

		 $this->db->query($sql);
	}

	function lihat_data()
	{
		$sql = "
			SELECT a.*, c.nama_divisi, b.nama_supplier FROM tb_pengakuan_hutang a 
			LEFT JOIN master_supplier b ON a.ID_SUPPLIER = b.id_supplier
			LEFT JOIN master_divisi c ON a.DEPARTEMEN = c.id_divisi
		";

		return $this->db->query($sql)->result();
	}

	function lihat_data_id($id){
		$sql = "
			SELECT a.* FROM tb_pengakuan_hutang a
			WHERE a.ID = '$id'
		";

		return $this->db->query($sql)->row();
	}

	function get_data_bukti($keyword){
		$sql = "
			SELECT a.* FROM tb_perintah_bayar_nota a
			WHERE NO_BUKTI LIKE '%$keyword%'
		";

		return $this->db->query($sql)->result();
	}

	function get_data_bukti_detail($id){
		$sql = "
			SELECT a.* FROM tb_perintah_bayar_nota a
			WHERE a.ID = '$id'
		";

		return $this->db->query($sql)->row();
	}

	function get_data_trx($id){
    	$sql = "
        SELECT pb.* , md.nama_divisi , ms.nama_supplier , ms.alamat_supplier FROM tb_pengakuan_hutang pb , master_divisi md, master_supplier ms WHERE pb.DEPARTEMEN = md.id_divisi AND pb.ID_SUPPLIER = ms.id_supplier AND pb.ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    

}
