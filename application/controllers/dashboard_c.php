<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_m','model');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title'    	=> 'Dashboard',
				'sub_menu' 	=> 'dashboard',
				'sub_menu1'	=> 'dashboard',
				'page' 	   	=> 'dashboard_v',
				'menu' 	   	=> 'dashboard_menu',
				'menu2'		=> '',
			);

		$this->load->view('home_v',$data);
	}

	function cek_no_di_spb(){
		$nomor = $this->input->post('nomor');
		$data = $this->model->tampil_no_spb($nomor);

		echo json_encode($data);
	}

	function cek_no_spb_di_opb(){
		$nomor = $this->input->post('nomor');
		$data2 = $this->model->tampil_no_spb_di_opb($nomor);

		echo json_encode($data2);
	}

	function cek_no_opb_di_po(){
		$nomor = $this->input->post('nomor');
		$data3 = $this->model->tampil_no_opb_di_po($nomor);

		echo json_encode($data3);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */