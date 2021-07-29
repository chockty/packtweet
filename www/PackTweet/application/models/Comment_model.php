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

    public function get_by_tweet_id($tweet_id)
    {
        $this->db->select('content, comments.created_at, name AS user_name');
        $this->db->where('tweet_id', $tweet_id);
        $this->db->order_by('comments.created_at', 'DESC');
        $this->db->join('users', 'users.id = comments.user_id', 'left');
        return $this->db->get('comments')->result_array();
    }
}