<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk_model extends CI_Model
{
    public function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function sunting_data($table, $data)
    {
        $this->db->replace($table, $data);
        

        // $this->db->where('id', $id);
        // $this->db->update($table, $data);
    }

    public function sunting_datas($id, $table, $data)
    {
        // $this->db->replace($table, $data);
        

        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

    public function getAll($table)
    {
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function getAlljoin($table1, $table2)
    {
        $query = $this->db->select('*,'.$table1.'.id AS idKab')
                        ->from($table1)
                        ->join($table2, $table2.'.id = '.$table1.'.id_provinsi')
                        ->get();
        return $query->result_array();
    }

    public function getById($table, $id)
    {
         $query = $this->db->get_where($table, ['id' => $id]);
         return $query->result_array();
    }

    public function hapus_data($id, $table)
    {
        // return "1451";
        // $query = $this->db->delete($table, array('id' => $id));
        if (!$this->db->delete($table, array('id' => $id))) {
            $error = $this->db->error();
            return $error['code'];
            // exit();        
        }
        // return TRUE;
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows > 0) {
            return TRUE;
        }else {
            return FALSE;
        };
        

    }
}