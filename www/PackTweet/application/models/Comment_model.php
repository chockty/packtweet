<?php

class Comment_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create($tweet_id)
    {
        $today = date('Y-m-d H:i:s');

        $data = [
            'user_id' => $_SESSION['user_id'],
            'tweet_id' => $tweet_id,
            'content' => $this->input->post('content'),
            'created_at' => $today,
            'updated_at' => $today
        ];
        return $this->db->insert('comments', $data);
    }
}