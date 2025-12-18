<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model
{
    public function get_all()
    {
        $result = $this->db->get('master_area')->result();

        $data = [];
        foreach ($result as $row) {
            $data[$row->id_area] = $row->nama_area;
        }
        return $data;
    }
}
