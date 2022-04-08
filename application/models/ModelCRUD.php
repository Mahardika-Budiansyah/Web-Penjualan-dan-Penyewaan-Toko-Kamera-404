<?php

class ModelCRUD extends CI_Model
{

    public function get_all_data($table)
    {
        $q = $this->db->get($table);
        return $q;
    }

    public function cek($table)
    {
		$this->db->select('*');
		$this->db->from($table);
		return $this->db->get()->num_rows();
	}

    public function insert($table,$data){
		$this->db->insert($table,$data);
	}

    public function get_by_id($table,$id){
		return $this->db->get_where($table,$id);
	}

	public function search_produk($title){
		$this->db->like('id_produk',$title, 'BOTH');
		$this->db->order_by('nama_produk','ASC');
		$this->db->limit(10);
		return $this->db->get('tbl_produk')->result();
	}

	public function update($table,$data,$pk,$id){
		$this->db->where($pk,$id);
		$this->db->update($table,$data);
	}

	public function deletekat($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function join($table1, $table2, $id){
		$this->db->join($table2,$id);
		return $this->db->get($table1);
	}

	public function jointiga($t1,$t2,$t3,$id1,$id2){
		$this->db->select('*');
		$this->db->from($t1);
		$this->db->join($t2,$id1);
		$this->db->join($t3,$id2);
		return $this->db->get();
	}

	public function joinempat($t1,$t2,$t3,$t4,$id1,$id2,$id3){
		$this->db->select('*');
		$this->db->from($t1);
		$this->db->join($t2,$id1);
		$this->db->join($t3,$id2);
		$this->db->join($t4,$id3);
		return $this->db->get();
	}

	public function joinlima($t1,$t2,$t3,$t4,$t5,$id1,$id2,$id3,$id4){
		$this->db->select('*');
		$this->db->from($t1);
		$this->db->join($t2,$id1);
		$this->db->join($t3,$id2);
		$this->db->join($t4,$id3);
		$this->db->join($t5,$id4);
		return $this->db->get();
	}

	public function joinenam($t1,$t2,$t3,$t4,$t5,$t6,$id1,$id2,$id3,$id4,$id5){
		$this->db->select('*');
		$this->db->from($t1);
		$this->db->join($t2,$id1);
		$this->db->join($t3,$id2);
		$this->db->join($t4,$id3);
		$this->db->join($t5,$id4);
		$this->db->join($t6,$id5);
		return $this->db->get();
	}

	public function level($table,$where){
		$this->db->get_where($table,$where);
	}

	public function find($id)
    {
        $result = $this->db->where('id_produk', $id)
                    	->limit(5)
                        ->get('tbl_produk');
        if($result->num_rows() > 0){
            return $result->row();
        } else {
            return array();
        }
    }
}
