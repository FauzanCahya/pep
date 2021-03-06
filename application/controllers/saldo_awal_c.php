<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saldo_awal_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('saldo_awal_m','pelanggan');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master Saldo Awal',
				'page'  	 => 'saldo_awal_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master saldo awal',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'saldo_awal',
				'lihat_data' => $this->pelanggan->lihat_data_saldo_awal(),
				'dt_kode_akun' => $this->pelanggan->lihat_data_kode_akun(),
				'url_simpan' => base_url().'saldo_awal_c/simpan',
				'url_hapus'  => base_url().'saldo_awal_c/hapus',
				'url_ubah'	 => base_url().'saldo_awal_c/ubah_pelanggan',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$kode_akun 	 = $this->input->post('kode_akun');
		$debet 	     = $this->input->post('debet');
		$debet 	     = str_replace(',', '', $debet);

		$kredit      = $this->input->post('kredit');
		$kredit 	 = str_replace(',', '', $kredit);

		$this->pelanggan->simpan_data_saldoawal($kode_akun,$debet,$kredit);
		$this->session->set_flashdata('sukses','1');
		redirect('saldo_awal_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->pelanggan->hapus_pelanggan($id);
		$this->session->set_flashdata('hapus','1');
		redirect('saldo_awal_c');
	}

	function data_saldo_awal_id()
	{
		$id = $this->input->post('id');
		$data = $this->pelanggan->data_saldo_awal_id($id);
		echo json_encode($data);
	}

	function ubah_pelanggan()
	{
		$id_saldo_awal 	= $this->input->post('id_saldo_awal');
		$ed_debet    	= $this->input->post('ed_debet');
		$ed_debet 	    = str_replace(',', '', $ed_debet);

		$ed_kredit 	    = $this->input->post('ed_kredit');
		$ed_kredit 	    = str_replace(',', '', $ed_kredit);
		
		$this->pelanggan->ubah_data_saldo_awal($id_saldo_awal, $ed_debet, $ed_kredit);
		$this->session->set_flashdata('sukses','1');
		redirect('saldo_awal_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */