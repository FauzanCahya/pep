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
				'url_simpan' => base_url().'saldo_awal_c/simpan',
				'url_hapus'  => base_url().'saldo_awal_c/hapus',
				'url_ubah'	 => base_url().'saldo_awal_c/ubah_pelanggan',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$kode_pelanggan 	 = $this->input->post('kode_pelanggan');
		$nama_pelanggan 	 = $this->input->post('nama_pelanggan');
		$alamat_pelanggan = $this->input->post('alamat_pelanggan');
		$telp 			 = $this->input->post('telp');
		$email			 = $this->input->post('email');
		$npwp 			 = $this->input->post('npwp');

		$this->pelanggan->simpan_data_pelanggan($kode_pelanggan,$nama_pelanggan,$alamat_pelanggan,$telp,$email,$npwp);
		$this->session->set_flashdata('sukses','1');
		redirect('pelanggan_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->pelanggan->hapus_pelanggan($id);
		$this->session->set_flashdata('hapus','1');
		redirect('pelanggan_c');
	}

	function data_pelanggan_id()
	{
		$id = $this->input->post('id');
		$data = $this->pelanggan->data_pelanggan_id($id);
		echo json_encode($data);
	}

	function ubah_pelanggan()
	{
		$id 					= $this->input->post('id_pelanggan_modal');
		$kode_pelanggan_modal  	= $this->input->post('kode_pelanggan_modal');
		$nama_pelanggan_modal 	= $this->input->post('nama_pelanggan_modal');
		$alamat_pelanggan_modal  = $this->input->post('alamat_pelanggan_modal');
		$telp_modal  			= $this->input->post('telp_modal');
		$email_modal 			= $this->input->post('email_modal');
		$npwp_modal 			= $this->input->post('npwp_modal');
		
		$this->pelanggan->ubah_data_pelanggan($id,$kode_pelanggan_modal,$nama_pelanggan_modal,$alamat_pelanggan_modal,$telp_modal,$email_modal,$npwp_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('pelanggan_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */