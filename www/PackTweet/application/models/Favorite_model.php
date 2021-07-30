<?php

class Favorite_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create($user_id, $tweet_id)
    {
        $today = date('Y-m-d H:i:s');

        $data = [
            'user_id' => $user_id,
            'tweet_id' => $tweet_id,
            'created_at' => $today,
        ];

        $this->db->insert('favorites', $data);
    }

    public function delete($user_id, $tweet_id)
    {
        $this->db->where('user_id', $user_id)
                 ->where('tweet_id', $tweet_id)
                 ->delete('favorites');
    }

    public function is_exists($user_id, $tweet_id)
    {
        $exists =  $this->db->where('user_id', $user_id)
                            ->where('tweet_id', $tweet_id)
                            ->from('favorites')
                            ->get()
                            ->result_array();

        if ($exists) {
            return true;
        } else {
            return false;
        }
    }
}