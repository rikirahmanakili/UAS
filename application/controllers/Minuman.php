<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Minuman extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_minuman');
		$this->load->model('m_kategori');
	}

	// List all your items
	public function index()
	{
		$data = array(
			'title' => 'Minuman',
			'minuman' => $this->m_minuman->get_all_data(),
			'isi' => 'minuman/v_minuman',
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	// Add a new item
	public function add()
	{
		$this->form_validation->set_rules('nama_minuman', 'Nama Minuman', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));
		$this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));
		$this->form_validation->set_rules('harga', 'Harga', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));
	
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));


		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif';
			$config['max_size']     = '2000';
			$this->upload->initialize($config);
			$field_name = "gambar";
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
					'title' => 'Add Minuman',
					'kategori' => $this->m_kategori->get_all_data(),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'minuman/v_add',
				);
				$this->load->view('layout/v_wrapper_backend', $data, FALSE);
			} else {
				$upload_data	= array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'nama_minuman' => $this->input->post('nama_minuman'),
					'id_kategori' => $this->input->post('id_kategori'),
					'harga' => $this->input->post('harga'),
					'deskripsi' => $this->input->post('deskripsi'),
					'gambar'	=> $upload_data['uploads']['file_name'],
				);
				$this->m_minuman->add($data);
				$this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
				redirect('minuman');
			}
		}

		$data = array(
			'title' => 'Add Minuman',
			'kategori' => $this->m_kategori->get_all_data(),
			'isi' => 'minuman/v_add',
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	//Update one item
	public function edit($id_minuman = NULL)
	{
		$this->form_validation->set_rules('nama_minuman', 'Nama Minuman', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));
		$this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));
		$this->form_validation->set_rules('harga', 'Harga', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));
		
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array(
			'required' => '%s Haris Diisi !!!'
		));


		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif';
			$config['max_size']     = '2000';
			$this->upload->initialize($config);
			$field_name = "gambar";
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
					'title' => 'Edit Minuman',
					'kategori' => $this->m_kategori->get_all_data(),
					'minuman'  => $this->m_minuman->get_data($id_minuman),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'minuman/v_edit',
				);
				$this->load->view('layout/v_wrapper_backend', $data, FALSE);
			} else {
				//hapus gambar
				$minuman = $this->m_minuman->get_data($id_minuman);
				if ($minuman->gambar != "") {
					unlink('./assets/gambar/' . $minuman->gambar);
				}
				//end hapus gambar
				$upload_data	= array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'id_minuman'	  => $id_minuman,
					'nama_minuman' => $this->input->post('nama_minuman'),
					'id_kategori' => $this->input->post('id_kategori'),
					'harga' => $this->input->post('harga'),
					'deskripsi' => $this->input->post('deskripsi'),
					'gambar'	=> $upload_data['uploads']['file_name'],
				);
				$this->m_minuman->edit($data);
				$this->session->set_flashdata('pesan', 'Data Berhasil Diganti !!!');
				redirect('minuman');
			}
			//jika tanpa ganti gambar
			$data = array(
				'id_minuman'	  => $id_minuman,
				'nama_minuman' => $this->input->post('nama_minuman'),
				'id_kategori' => $this->input->post('id_kategori'),
				'harga' => $this->input->post('harga'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
			$this->m_minuman->edit($data);
			$this->session->set_flashdata('pesan', 'Data Berhasil Diganti !!!');
			redirect('minuman');
		}

		$data = array(
			'title' => 'Edit Minuman',
			'kategori' => $this->m_kategori->get_all_data(),
			'minuman'  => $this->m_minuman->get_data($id_minuman),
			'isi' => 'minuman/v_edit',
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	//Delete one item
	public function delete($id_minuman = NULL)
	{
		//hapus gambar
		$minuman = $this->m_minuman->get_data($id_minuman);
		if ($minuman->gambar != "") {
			unlink('./assets/gambar/' . $minuman->gambar);
		}
		//end hapus gambar
		$data = array('id_minuman' => $id_minuman);
		$this->m_minuman->delete($data);
		$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
		redirect('minuman');
	}
}

/* End of file Minuman.php */
