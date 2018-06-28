<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun_barang_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('akun_barang_m','barang');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master barang',
				'page'  	 => 'akun_barang_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master barang',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master barang',
				'lihat_data' => $this->barang->lihat_data_barang(),
				'url_simpan' => base_url().'akun_barang_c/simpan',
				'url_hapus'  => base_url().'akun_barang_c/hapus',
				'url_ubah'	 => base_url().'akun_barang_c/ubah_barang',
			);
		
		$this->load->view('home_v',$data);
	}

	function ubah_data($id="")
	{

		$dt_debit = $this->db->query("SELECT NAMA_GRUP , ID FROM ak_grup_kode_akun ag , master_barang ms WHERE ms.akun_debit = ag.ID AND ms.id_barang = '$id'")->row();
		$dt_kredit = $this->db->query("SELECT NAMA_GRUP , ID FROM ak_grup_kode_akun ag , master_barang ms WHERE ms.akun_kredit = ag.ID AND ms.id_barang = '$id'")->row();
		$dt_akun = $this->db->query("SELECT * FROM ak_grup_kode_akun")->result();
		$data = array(
				'title' 	 => 'Master barang',
				'page'  	 => 'edit_akun_barang_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master barang',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'Master barang',
				'lihat_data' => $this->barang->lihat_data_barang_edit($id),
				'akun_kredit' => $dt_kredit,
				'akun_debit' => $dt_debit,
				'dt_akun'    => $dt_akun,
				'url_simpan' => base_url().'akun_barang_c/simpan_akun',
				'url_hapus'  => base_url().'akun_barang_c/hapus',
				'url_ubah'	 => base_url().'akun_barang_c/ubah_barang',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$kode_barang 	 = $this->input->post('kode_barang');
		$nama_barang 	 = $this->input->post('nama_barang');
		$alamat_barang = $this->input->post('alamat_barang');
		$telp 			 = $this->input->post('telp');
		$email			 = $this->input->post('email');
		$npwp 			 = $this->input->post('npwp');

		$this->barang->simpan_data_barang($kode_barang,$nama_barang,$alamat_barang,$telp,$email,$npwp);
		$this->session->set_flashdata('sukses','1');
		redirect('barang_c');
	}

	function simpan_akun()
	{
		$kode_barang 	 = $this->input->post('kode_barang');
		$nama_barang 	 = $this->input->post('nama_barang');
		$akun_debit 	 = $this->input->post('akun_debit');
		$akun_kredit 	 = $this->input->post('akun_kredit');

		$this->barang->simpan_data_barang_akun($kode_barang,$nama_barang,$akun_debit,$akun_kredit);
		$this->session->set_flashdata('sukses','1');
		redirect('akun_barang_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->barang->hapus_barang($id);
		$this->session->set_flashdata('hapus','1');
		redirect('barang_c');
	}

	function data_barang_id()
	{
		$id = $this->input->post('id');
		$data = $this->barang->data_barang_id($id);
		echo json_encode($data);
	}

	function ubah_barang()
	{
		$id 					= $this->input->post('id_barang_modal');
		$kode_barang_modal  	= $this->input->post('kode_barang_modal');
		$nama_barang_modal 	= $this->input->post('nama_barang_modal');
		$alamat_barang_modal  = $this->input->post('alamat_barang_modal');
		$telp_modal  			= $this->input->post('telp_modal');
		$email_modal 			= $this->input->post('email_modal');
		$npwp_modal 			= $this->input->post('npwp_modal');
		
		$this->barang->ubah_data_barang($id,$kode_barang_modal,$nama_barang_modal,$alamat_barang_modal,$telp_modal,$email_modal,$npwp_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('barang_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */