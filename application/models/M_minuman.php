<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_minuman extends CI_Model
{
	public function get_all_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_minuman');
		$this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_minuman.id_kategori', 'left');
		$this->db->order_by('tbl_minuman.id_minuman', 'desc');
		return $this->db->get()->result();
	}

	public function get_data($id_minuman)
	{
		$this->db->select('*');
		$this->db->from('tbl_minuman');
		$this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_minuman.id_kategori', 'left');
		$this->db->where('id_minuman', $id_minuman);
		return $this->db->get()->row();
	}

	public function add($data)
	{
		$this->db->insert('tbl_minuman', $data);
	}

	public function edit($data)
	{
		$this->db->where('id_minuman', $data['id_minuman']);
		$this->db->update('tbl_minuman', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_minuman', $data['id_minuman']);
		$this->db->delete('tbl_minuman', $data);
	}
}
