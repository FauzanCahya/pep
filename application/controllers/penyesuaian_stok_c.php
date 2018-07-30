<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penyesuaian_stok_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('penyesuaian_stok_m','pelanggan');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 		=> 'Penyesuaian Stok',
			    'page'  	 		=> 'penyesuaian_stok_v',
			    'sub_menu' 	 		=> 'Akunting',
			    'sub_menu1'	 		=> 'Penyesuaian Stok',
			    'menu' 	   	 		=> 'permintaan',
			    'menu2'		 		=> 'penyesuaian_stok',
				'lihat_data_barang' => $this->pelanggan->lihat_data_barang(),
				'lihat_data_akun' => $this->pelanggan->lihat_data_akun(),
				'url_simpan' => base_url().'penyesuaian_stok_c/simpan',
				'url_hapus'  => base_url().'penyesuaian_stok_c/hapus',
				'url_ubah'	 => base_url().'penyesuaian_stok_c/ubah_pelanggan',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$id_barang 	   = $this->input->post('id_barang');
		$nama_barang   = $this->input->post('nama_barang');
		$qty_opname    = $this->input->post('qty_opname');
		$qty_opname    = str_replace(',', '', $qty_opname);
		$harga_opname  = $this->input->post('harga_opname');
		$harga_opname    = str_replace(',', '', $harga_opname);
		$ket_opname	   = $this->input->post('ket_opname');


		$this->pelanggan->simpan_data_opname($id_barang,$nama_barang,$qty_opname,$harga_opname,$ket_opname);

		$kode_akun  = $this->input->post('kode_akun');
	    $debet      = $this->input->post('debet');
	    $kredit     = $this->input->post('kredit');
	    $keterangan = $this->input->post('keterangan');

	    foreach ($kode_akun as $key => $val) {
	    	$this->model->save_akuntansi($val, $debet[$key], $kredit[$key], $keterangan[$key]);
	    }

		$this->session->set_flashdata('sukses','1');
		redirect('penyesuaian_stok_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->pelanggan->hapus_pelanggan($id);
		$this->session->set_flashdata('hapus','1');
		redirect('penyesuaian_stok_c');
	}

	function barang_id()
	{
		$id = $this->input->post('id');
		$data = $this->pelanggan->barang_id($id);
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
		redirect('penyesuaian_stok_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */