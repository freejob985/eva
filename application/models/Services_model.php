<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Services_model extends CI_Model {

    private $table = 'services';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($data = [])
    {
        return $this->db->insert($this->table, $data);
    }

    public function read_all()
    {
        return $this->db->select("services.*, branches.name as branch_name, doctors.name as doctor_device_name")
                        ->from($this->table)
                        ->join('branches', 'branches.id = services.branch', 'left')
                        ->join('doctors', 'doctors.id = services.doctor_device', 'left')
                        ->order_by('id', 'desc')
                        ->get()
                        ->result();
    }

    public function read_by_id($id = null)
    {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('id', $id)
                        ->get()
                        ->row();
    }

    public function update($data = [])
    {
        return $this->db->where('id', $data['id'])
                        ->update($this->table, $data);
    }

    public function delete($id = null)
    {
        $this->db->where('id', $id)
                 ->delete($this->table);

        return $this->db->affected_rows() ? true : false;
    }
}
