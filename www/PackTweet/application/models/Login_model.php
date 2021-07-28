<?php

class Login_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function validate($input) {
        $this->db->where('email', $input['email']);
        $user = $this->db->get('users')->row_array();
        return password_verify($input['password'], $user['password']);
    }

    public function get_by_email($email) {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();
    }
}