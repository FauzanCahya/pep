<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_level_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master_level_m','depart');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master level',
				'page'  	 => 'master_level_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master level',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'departemen',
				'lihat_data' => $this->depart->lihat_data_depart(),
				'url_simpan' => base_url().'master_level_c/simpan',
				'url_hapus'  => base_url().'master_level_c/hapus',
				'url_ubah'	 => base_url().'master_level_c/ubah_depart',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$nama_depart = $this->input->post('nama_depart');

		$this->depart->simpan_data_depart($nama_depart);
		$this->session->set_flashdata('sukses','1');
		redirect('master_level_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
	$this->depart->hapus_depart($id);
		$this->session->set_flashdata('hapus','1');
		redirect('master_level_c');
	}

	function data_depart_id()
	{
		$id = $this->input->post('id');
		$data = $this->depart->data_depart_id($id);
		echo json_encode($data);
	}

	function ubah_depart()
	{
		$id 	   			= $this->input->post('id_depart_modal');
		$nama_depart_modal  = $this->input->post('nama_depart_modal');
		
		$this->depart->ubah_data_depart($id,$nama_depart_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('master_level_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */