<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_services_model extends CI_Model {

    private $table = 'booking_services';

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
        return $this->db->select("booking_services.*, branches.name as branch_name, doctors.name as doctor_device_name")
                        ->from($this->table)
                        ->join('branches', 'branches.id = booking_services.branch_id', 'left')
                        ->join('doctors', 'doctors.id = booking_services.doctor_device_id', 'left')
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
