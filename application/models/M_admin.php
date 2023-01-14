<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
	public function total_minuman()
	{
		return $this->db->get('tbl_minuman')->num_rows();
	}

	public function total_kategori()
	{
		return $this->db->get('tbl_kategori')->num_rows();
	}
	
	public function total_user()
	{
		return $this->db->get('tbl_user')->num_rows();
	}

	public function data_setting()
	{
		
	}

	public function edit($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tbl_setting', $data);
	}
}
