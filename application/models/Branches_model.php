<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Branches_model extends CI_Model {

    private $table = 'branches';

    public function __construct()
    {
        parent::__construct();
    }

    // دالة الإضافة
    public function create($data = [])
    {
        return $this->db->insert($this->table, $data);
    }

    // دالة العرض (جلب كل السجلات)
    public function read_all()
    {
        return $this->db->select("*")
                        ->from($this->table)
                        ->order_by('id', 'desc')
                        ->get()
                        ->result();
    }

    // دالة العرض (جلب سجل بناءً على المعرف)
    public function read_by_id($id = null)
    {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('id', $id)
                        ->get()
                        ->row();
    }

    // دالة التعديل
    public function update($data = [])
    {
        return $this->db->where('id', $data['id'])
                        ->update($this->table, $data);
    }

    // دالة الحذف
    public function delete($id = null)
    {
        $this->db->where('id', $id)
                 ->delete($this->table);

        return $this->db->affected_rows() ? true : false;
    }
}
