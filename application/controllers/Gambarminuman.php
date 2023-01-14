<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gambarminuman extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_gambarminuman');
		$this->load->model('m_minuman');
	}


	public function index()
	{
		$data = array(
			'title' => 'Gambar Minuman',
			'gambarminuman' => $this->m_gambarminuman->get_all_data(),
			'isi' => 'gambarminuman/v_index',
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add($id_minuman)
	{
		$this->form_validation->set_rules('ket', 'Ket Gambar', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambarminuman/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
			$config['max_size']     = '2000';
			$this->upload->initialize($config);
			$field_name = "gambar";
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
					'title' => 'Add Gambar Minuman',
					'error_upload' => $this->upload->display_errors(),
					'minuman'  => $this->m_minuman->get_data($id_minuman),
					'gambar' => $this->m_gambarminuman->get_gambar($id_minuman),
					'isi' => 'gambarminuman/v_add',
				);
				$this->load->view('layout/v_wrapper_backend', $data, FALSE);
			} else {
				$upload_data	= array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/gambarminuman/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'id_minuman' => $id_minuman,
					'ket' => $this->input->post('ket'),
					'gambar'	=> $upload_data['uploads']['file_name'],
				);
				$this->m_gambarminuman->add($data);
				$this->session->set_flashdata('pesan', 'Gambar Berhasil Ditambahkan !!!');
				redirect('gambarminuman/add/' . $id_minuman);
			}
		}

		$data = array(
			'title' => 'Add Gambar Minuman',
			'minuman'  => $this->m_minuman->get_data($id_minuman),
			'gambar' => $this->m_gambarminuman->get_gambar($id_minuman),
			'isi' => 'gambarminuman/v_add',
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	//Delete one item
	public function delete($id_minuman, $id_gambar)
	{
		//hapus gambar
		$gambar = $this->m_gambarminuman->get_data($id_gambar);
		if ($gambar->gambar != "") {
			unlink('./assets/gambarminuman/' . $gambar->gambar);
		}
		//end hapus gambar
		$data = array('id_gambar' => $id_gambar);
		$this->m_gambarminuman->delete($data);
		$this->session->set_flashdata('pesan', 'Gambar Berhasil Dihapus !!!');
		redirect('gambarminuman/add/' . $id_minuman);
	}
}
