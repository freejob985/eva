<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bserves_model extends CI_Model {

    private $table = 'bserves';

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
    return $this->db->select('*')          // اختر جميع الأعمدة من جدول bserves
                    ->from($this->table)   // من جدول bserves
                    ->order_by('id', 'desc')  // رتب حسب id بشكل تنازلي
                    ->get()                 // تنفيذ الاستعلام
                    ->result();             // الحصول على النتائج
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
