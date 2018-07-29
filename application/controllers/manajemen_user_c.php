<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manajemen_user_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('manajemen_user_m','model');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
			'title' 	 => 'Master Manajemen User',
			'page'  	 => 'manajemen_user_v',
			'sub_menu' 	 => 'master data',
			'sub_menu1'	 => 'master kategori',
			'menu' 	   	 => 'master_data',
			'menu2'		 => 'master kategori',
			'lihat_data' => $this->model->get_user(),
			'url_simpan' => base_url().'manajemen_user_c/simpan',
			'url_hapus'  => base_url().'manajemen_user_c/hapus',
			'url_ubah'	 => base_url().'manajemen_user_c/ubah_divisi',
		);
		
		$this->load->view('home_v',$data);
	}

	function get_user_id(){
		$id = $this->input->post('id');
		$data = $this->model->get_user_id($id);
		echo json_encode($data);
	}

	function simpan()
	{
		$id_user = $this->input->post('id_user');
		$id_menu_lev_1 = $this->input->post('id_menu_lev1');
		$id_menu_lev_2 = $this->input->post('id_menu_lev2');
		$count = count($id_menu_lev_2);

		$this->model->hapus($id_user);

		for($i=0; $i<$count; $i++){
			print_r($id_menu_lev_1[$i]);
			die();
			$this->model->simpan($id_user,$id_menu_lev_1[$i],$id_menu_lev_2[$i]);
			// $this->model->ubah($id_user,$id_menu_lev_1[$i]);
		}

		$this->session->set_flashdata('simpan','1');
		redirect('manajemen_user_c');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */