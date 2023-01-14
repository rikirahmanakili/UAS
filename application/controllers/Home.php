<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
	}


	public function index()
	{
		$data = array(
			'title' => 'Home',
			'minuman' => $this->m_home->get_all_data(),
			'isi' => 'v_home',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function kategori($id_kategori)
	{
		$kategori = $this->m_home->kategori($id_kategori);
		$data = array(
			'title' => 'Kategori Minuman : ' . $kategori->nama_kategori,
			'minuman' => $this->m_home->get_all_data_minuman($id_kategori),
			'isi' => 'v_kategori_minuman',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function detail_minuman($id_minuman)
	{
		$data = array(
			'title' => 'Detail Minuman',
			'gambar' => $this->m_home->gambar_minuman($id_minuman),
			'minuman' => $this->m_home->detail_minuman($id_minuman),
			'isi' => 'v_detail_minuman',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}
}

/* End of file Home.php */
