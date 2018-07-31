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

	function cek_no_spb_first(){
		$nomor = $this->input->post('nomor');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_no_spb($nomor,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_spb_di_opb(){
		$nomor = $this->input->post('nomor');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data2 = $this->model->tampil_no_spb_di_opb($nomor,$sie,$tahun);

		echo json_encode($data2);
	}

	function cek_no_opb_di_po(){
		$no_opb = $this->input->post('no_opb');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data3 = $this->model->tampil_no_opb_di_po($no_opb,$sie,$tahun);

		echo json_encode($data3);
	}

	function cek_no_lpb(){
		$no_po = $this->input->post('no_po');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_no_lpb($no_po,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_opb_first(){
		$nomor = $this->input->post('nomor');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_opb_first($nomor,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_spb_by_opb(){
		$no_opb = $this->input->post('no_opb');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_spb_dr_first_opb($no_opb,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_po_fisrt(){
		$nomor = $this->input->post('nomor');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_po_first($nomor,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_lpb_by_po(){
		$no_po = $this->input->post('no_po');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_no_lpb_dr_po($no_po,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_opb_by_po(){
		$no_po = $this->input->post('no_po');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_no_opb_by_po($no_po,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_spb_by_opb2(){
		$no_opb = $this->input->post('no_opb');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_no_spb_by_opb($no_opb,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_lpb_first(){
		$nomor = $this->input->post('nomor');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_lpb_first($nomor,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_po_by_lpb(){
		$no_po = $this->input->post('no_po');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_po_first($no_po,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_opb_by_po2(){
		$no_opb = $this->input->post('no_opb');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_opb_first($no_opb,$sie,$tahun);

		echo json_encode($data);
	}

	function cek_no_spb_by_opb3(){
		$no_spb = $this->input->post('no_spb');
		$sie = $this->input->post('sie');
		$tahun = $this->input->post('tahun');

		$data = $this->model->tampil_no_spb($no_spb,$sie,$tahun);

		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */