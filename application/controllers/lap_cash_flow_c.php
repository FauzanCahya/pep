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

	function cetak(){
		$filter = $this->input->post('pilih'); 
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$view = "pdf/lap_cash_flow_pdf";
		$sql ='';

		if($filter == 'Harian'){
			$sql = "SELECT 
						* 
					FROM tb_pengeluaran_giro 
					WHERE STR_TO_DATE(TGL_KELUAR, '%d-%c-%Y') <= STR_TO_DATE('$tanggal_akhir' , '%d-%c-%Y') 
	            	AND STR_TO_DATE(TGL_KELUAR, '%d-%c-%Y') >= STR_TO_DATE('$tanggal_awal' , '%d-%c-%Y')";
		}else{
			$sql = "SELECT * FROM tb_pengeluaran_giro WHERE TGL_KELUAR LIKE '%-$bulan-$tahun%'";
		}

        $dt = $this->db->query($sql)->result();
		
		$data = array(
			'title' 		=> 'LAPORAN CASH FLOW',
			'dt'			=> $dt,
			'filename'		=> date('dmY').'_lap_cash_flow'
		);
		$this->load->view($view,$data);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */