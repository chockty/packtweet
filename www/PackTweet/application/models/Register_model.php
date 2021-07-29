<?php

class Register_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function register($request)
    {
        $today = date('Y-m-d H:i:s');

        $request['created_at'] = $today;
        $request['updated_at'] = $today;

        $this->db->insert('users', $request);
        return $this->db->insert_id();
    }
}