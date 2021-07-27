<?php

class Login_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function validate($input) {
      $this->db->where('email', $input['email']);
      $this->db->where('password', $input['password']);
      return $this->db->get('users', 1);
    }
}