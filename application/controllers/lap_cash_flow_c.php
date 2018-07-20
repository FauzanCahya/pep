<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lap_cash_flow_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c');
        }

        $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	public function index()
	{
		$data = array(
			'title' 	=> 'Laporan Cash Flow',
			'page'  	=> 'lap_cash_flow_v',
			'sub_menu' 	=> 'Laporan',
			'sub_menu1'	=> 'Cash Flow',
			'menu' 	   	=> 'master_data',
			'menu2'		=> ''
		);
		
		$this->load->view('home_v',$data);
	}

	function datetostr($var){
		if($var == "01"){
			$var = "Januari";
		} else if($var == "02"){
			$var = "Februari";
		} else if($var == "03"){
			$var = "Maret";
		} else if($var == "04"){
			$var = "April";
		} else if($var == "05"){
			$var = "Mei";
		} else if($var == "06"){
			$var = "Juni";
		} else if($var == "07"){
			$var = "Juli";
		} else if($var == "08"){
			$var = "Agustus";
		} else if($var == "09"){
			$var = "September";
		} else if($var == "10"){
			$var = "Oktober";
		} else if($var == "11"){
			$var = "November";
		} else if($var == "12"){
			$var = "Desember";
		}

		return $var;
	}

	function cetak(){
		$filter = $this->input->post('pilih'); 
		$bank = $this->input->post('bank'); 
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$view = "pdf/lap_cash_flow_pdf";

		if($filter == 'Harian'){
			$sql = "
				SELECT
					SUM(a.SALDO_BLN_LALU) AS SALDO_BLN_LALU,
					SUM(a.MUTASI) AS MUTASI
				FROM(
					SELECT
						IFNULL(SUM(SA.TOTAL),0) AS SALDO_BLN_LALU,
						'0' AS MUTASI
					FROM(
						SELECT
							a.ID,
							a.NO_VOUCHER,
							a.TGL,
							a.TOTAL
						FROM ak_input_voucher a
						WHERE a.TIPE != 'JS'
						AND STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tanggal_akhir' , '%d-%c-%Y')

						UNION ALL

						SELECT
							a.ID,
							a.NO_BUKTI AS NO_VOUCHER,
							a.TGL,
							(a.DEBET - a.KREDIT) AS TOTAL
						FROM ak_input_voucher_lainnya a
						WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tanggal_akhir' , '%d-%c-%Y')
					) SA

					UNION ALL

					SELECT
						'0' AS SALDO_BLN_LALU,
						IFNULL(SUM(MUT.TOTAL),0) AS MUTASI
					FROM(
						SELECT
							a.ID,
							a.NO_VOUCHER,
							a.TGL,
							a.TOTAL
						FROM ak_input_voucher a
						WHERE a.TIPE != 'JS'
						AND STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tanggal_akhir' , '%d-%c-%Y') 
						AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tanggal_awal' , '%d-%c-%Y')

						UNION ALL

						SELECT
							a.ID,
							a.NO_BUKTI AS NO_VOUCHER,
							a.TGL,
							(a.DEBET - a.KREDIT) AS TOTAL
						FROM ak_input_voucher_lainnya a
						WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tanggal_akhir' , '%d-%c-%Y') 
						AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tanggal_awal' , '%d-%c-%Y')
					) MUT
				) a
			";
	        $dt = $this->db->query($sql)->result();
		}else{
			$bulan_lalu = intval($bulan) - 1;
			if($bulan_lalu == 0){
				$bulan_lalu = 12;
			}

			$bulan_txt = '';
			if($bulan_lalu < 10){
				$bulan_txt = '0'.intval($bulan_lalu);
			}

			$judul = date('1-m-Y')." s/d ".date('t-m-Y');

			$sql = "
				SELECT
					SUM(a.SALDO_BLN_LALU) AS SALDO_BLN_LALU,
					SUM(a.MUTASI) AS MUTASI
				FROM(
					SELECT
						IFNULL(SUM(SA.TOTAL),0) AS SALDO_BLN_LALU,
						'0' AS MUTASI
					FROM(
						SELECT
							a.ID,
							a.NO_VOUCHER,
							a.TGL,
							a.TOTAL
						FROM ak_input_voucher a
						WHERE a.TIPE != 'JS'
						AND a.TGL LIKE '%-$bulan_txt-$tahun%'

						UNION ALL

						SELECT
							a.ID,
							a.NO_BUKTI AS NO_VOUCHER,
							a.TGL,
							(a.DEBET - a.KREDIT) AS TOTAL
						FROM ak_input_voucher_lainnya a
						WHERE a.TGL LIKE '%-$bulan_txt-$tahun%'
					) SA

					UNION ALL

					SELECT
						'0' AS SALDO_BLN_LALU,
						IFNULL(SUM(MUT.TOTAL),0) AS MUTASI
					FROM(
						SELECT
							a.ID,
							a.NO_VOUCHER,
							a.TGL,
							a.TOTAL
						FROM ak_input_voucher a
						WHERE a.TIPE != 'JS'
						AND a.TGL LIKE '%-$bulan-$tahun%'

						UNION ALL

						SELECT
							a.ID,
							a.NO_BUKTI AS NO_VOUCHER,
							a.TGL,
							(a.DEBET - a.KREDIT) AS TOTAL
						FROM ak_input_voucher_lainnya a
						WHERE a.TGL LIKE '%-$bulan-$tahun%'
					) MUT
				) a
			";
        	$dt = $this->db->query($sql)->result();
		}

		
		$data = array(
			'title' 		=> 'LAPORAN CASH FLOW',
			'dt'			=> $dt,
			'filename'		=> date('dmY').'_lap_cash_flow',
			'bank'			=> $bank,
			'judul'			=> $judul
		);

		$this->load->view($view,$data);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */