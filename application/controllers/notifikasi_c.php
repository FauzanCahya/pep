<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class notifikasi_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('notifikasi_m','notifikasi');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master notifikasi',
				'page'  	 => 'notifikasi_v',
				'sub_menu' 	 => 'Setup',
				'sub_menu1'	 => 'master notifikasi',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master notifikasi',
				'lihat_data' => $this->notifikasi->lihat_data_notifikasi(),
				'url_simpan' => base_url().'notifikasi_c/simpan',
				'url_hapus'  => base_url().'notifikasi_c/hapus',
				'url_ubah'	 => base_url().'notifikasi_c/ubah_notifikasi',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$hari 	 = $this->input->post('hari');
		$this->notifikasi->simpan_data_notifikasi($hari);
		$this->session->set_flashdata('sukses','1');
		redirect('notifikasi_c');
	}

	function hapus()
	{
		// $id = $this->input->post('id_hapus');
		// $this->notifikasi->hapus_notifikasi($id);
		// $this->session->set_flashdata('hapus','1');
		// redirect('notifikasi_c');
	}

	function data_notifikasi_id()
	{
		// $id = $this->input->post('id');
		// $data = $this->notifikasi->data_notifikasi_id($id);
		// echo json_encode($data);
	}

	function ubah_notifikasi()
	{
		// $id 					= $this->input->post('id_notifikasi_modal');
		// $id_satuan_1_modal  	= $this->input->post('id_satuan_1_modal');
		// $id_satuan_2_modal 		= $this->input->post('id_satuan_2_modal');
		// $nilai_1_modal  		= $this->input->post('nilai_1_modal');
		// $nilai_2_modal  		= $this->input->post('nilai_2_modal');
		
		// $this->notifikasi->ubah_data_notifikasi($id,$id_satuan_1_modal,$id_satuan_2_modal,$nilai_1_modal,$nilai_2_modal);
		// $this->session->set_flashdata('sukses','1');
		// redirect('notifikasi_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */