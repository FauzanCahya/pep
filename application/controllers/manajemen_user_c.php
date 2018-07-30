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
			'sub_menu' 	 => 'Setup',
			'sub_menu1'	 => 'Manajemen User',
			'menu' 	   	 => 'setup',
			'menu2'		 => 'manajemen_user',
			'lihat_data' => $this->model->get_user(),
			'url_simpan' => base_url().'manajemen_user_c/simpan',
			'url_hapus'  => base_url().'manajemen_user_c/hapus',
			'url_ubah'	 => base_url().'manajemen_user_c/ubah_divisi',
		);
		
		$this->load->view('home_v',$data);
	}

	function hak_akses($id_user){
		$dt_pegawai 	= $this->model->get_user_id($id_user);

		$data = array(
			'title' 	 => 'Hak Akses',
			'page'  	 => 'hak_akses_v',
			'sub_menu' 	 => 'Setup',
			'sub_menu1'	 => 'Hak Akses',
			'menu' 	   	 => 'setup',
			'menu2'		 => 'manajemen_user',
			'lihat_data' => $this->model->get_user(),
			'url_simpan' => base_url().'manajemen_user_c/simpan',
			'url_hapus'  => base_url().'manajemen_user_c/hapus',
			'url_ubah'	 => base_url().'manajemen_user_c/ubah_divisi',
			'id_user'	 => $id_user,
			'get_menu_1' => $this->model->get_data_menu_1($id_user),
			'dt_pegawai' => $dt_pegawai,
			'id_pegawai' => $id_user,
		);

		$this->load->view('home_v',$data);
	}

	function get_user_id(){
		$id = $this->input->post('id');
		$data = $this->model->get_user_id($id);
		echo json_encode($data);
	}

	function get_divisi(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->get_divisi($keyword);
		echo json_encode($data);
	}

	function simpan()
	{
		$id_user = $this->input->post('id_pegawai2');
		$menu_portal     = $this->input->post('menu_portal');
		$ch_menu2        = $this->input->post('ch_menu2');
		$ch_menu3        = $this->input->post('ch_menu3');

		$this->model->hapus($id_user);

		foreach ($menu_portal as $key => $m_portal) {
			$this->model->simpan($id_user, $m_portal, 'MENU_PORTAL');
		}

		foreach ($ch_menu2 as $key => $m2) {
			$this->model->simpan($id_user, $m2, 'MENU_2');
		}

		foreach ($ch_menu3 as $key => $m3) {
			$this->model->simpan($id_user, $m3, 'MENU_3');
		}

		$this->session->set_flashdata('simpan','1');
		redirect('manajemen_user_c');
	}

	function ubah(){
		$id = $this->input->post('id_ubah');
		$username = $this->input->post('username_ubah');
		$password = $this->input->post('password_ulang_ubah');
		$nama_user = $this->input->post('nama_lengkap_ubah');

		if($password != ""){
			$this->model->ubah_with_pass($id,$username,md5($password),$nama_user);
		}else{
			$this->model->ubah_no_pass($id,$username,$nama_user);
		}

		$this->session->set_flashdata('ubah','1');
		redirect('manajemen_user_c');
	}

	function simpan_user(){
		$username = $this->input->post('username');
		$password = $this->input->post('password_ulang');
		$nama_user = $this->input->post('nama_lengkap');
		$departemen = '9';
		$level = $this->input->post('level');

		$this->model->simpan_user($username,md5($password),$nama_user,$departemen,$level);

		$this->session->set_flashdata('simpan','1');
		redirect('manajemen_user_c');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */