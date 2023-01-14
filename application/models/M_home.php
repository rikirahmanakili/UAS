<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{
	public function get_all_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_minuman');
		$this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_minuman.id_kategori', 'left');
		$this->db->order_by('tbl_minuman.id_minuman', 'desc');
		return $this->db->get()->result();
	}

	public function get_all_data_kategori()
	{
		$this->db->select('*');
		$this->db->from('tbl_kategori');
		$this->db->order_by('id_kategori', 'desc');
		return $this->db->get()->result();
	}

	public function detail_minuman($id_minuman)
	{
		$this->db->select('*');
		$this->db->from('tbl_minuman');
		$this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_minuman.id_kategori', 'left');
		$this->db->where('id_minuman', $id_minuman);
		return $this->db->get()->row();
	}

	public function gambar_minuman($id_minuman)
	{
		$this->db->select('*');
		$this->db->from('tbl_gambar');
		$this->db->where('id_minuman', $id_minuman);
		return $this->db->get()->result();
	}

	public function kategori($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('tbl_kategori');
		$this->db->where('id_kategori', $id_kategori);
		return $this->db->get()->row();
	}

	public function get_all_data_minuman($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('tbl_minuman');
		$this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_minuman.id_kategori', 'left');
		$this->db->where('tbl_minuman.id_kategori', $id_kategori);
		return $this->db->get()->result();
	}
}
