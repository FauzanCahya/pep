<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi_m','kategori');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master Transaksi',
				'page'  	 => 'transaksi_v',
				'sub_menu' 	 => 'Master Data',
				'sub_menu1'	 => 'Master Transaksi',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master kategori',
				'lihat_data' => $this->kategori->get_kat_barang(),
				'kode_akun'	 => $this->kategori->get_kode_akun(),
				'konsumen'	 => $this->kategori->get_konsumen(),
				'bank'	 	 => $this->kategori->get_bank(),
				'trx_lain'	 => $this->kategori->get_trx_lain(),
				'url_simpan' => base_url().'kategori_barang_c/simpan',
				'url_hapus'  => base_url().'kategori_barang_c/hapus',
				'url_ubah'	 => base_url().'kategori_barang_c/ubah_divisi',
			);
		
		$this->load->view('home_v',$data);
	}

	function get_kat_barang_id(){
		$id = $this->input->post('id');
		$data = $this->kategori->get_kat_barang_id($id);
		echo json_encode($data);
	}

	function simpan_akun(){
		$id_kategori = $this->input->post('id_kategori');
		$kode_akun = $this->input->post('kode_akun');
		$tipe = $this->input->post('tipe');
		$field = '';

		if($tipe == 'Akun Terima'){
			$field = 'kode_akun_terima';
		}else if($tipe == 'Akun Pakai'){
			$field = 'kode_akun_pakai';
		}else{
			$field = 'kode_akun_hutang';
		}

		$this->kategori->simpan_kode_akun($id_kategori,$field,$kode_akun);
		
		echo '1';
	}

	function get_konsumen_id(){
		$id = $this->input->post('id');
		$data = $this->kategori->get_konsumen_id($id);
		echo json_encode($data);
	}

	function simpan_akun_kon(){
		$id_konsumen = $this->input->post('id_konsumen');
		$kode_akun = $this->input->post('kode_akun');
		$tipe = $this->input->post('tipe');
		$field = '';

		if($tipe == 'Akun Hutang'){
			$field = 'akun_hutang_dagang';
		}else{
			$field = 'akun_piutang_barang';
		}

		$this->kategori->simpan_kode_akun_kon($id_konsumen,$field,$kode_akun);
		
		echo '1';
	}

	function get_bank_id(){
		$id = $this->input->post('id');
		$data = $this->kategori->get_bank_id($id);
		echo json_encode($data);
	}

	function simpan_akun_bank(){
		$id_bank = $this->input->post('id_bank');
		$kode_akun = $this->input->post('kode_akun');

		$this->kategori->simpan_kode_bank($id_bank,$kode_akun);

		echo '';
	}

	function get_trx_lain_id(){
		$id = $this->input->post('id');
		$data = $this->kategori->get_trx_lain_id($id);
		echo json_encode($data);
	}

	function simpan_akun_trx_lain(){
		$id_trx = $this->input->post('id_trx');
		$kode_akun = $this->input->post('kode_akun');
		
		$this->kategori->simpan_kode_trx_lain($id_trx,$kode_akun);

		echo '1';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */