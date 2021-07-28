<?php

class Tweet_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_tweets()
    {
				$this->db->select('name, content, tweets.created_at, tweets.id AS tweet_id');
        $this->db->where('tweets.deleted_at', NULL);
        $this->db->order_by('tweets.created_at', 'DESC');
        $this->db->join('users', 'users.id = tweets.user_id');
        return $this->db->get('tweets')->result_array();
    }

    public function createTweet()
    {
        $today = date('Y-m-d H:i:s');

        $data = [
            'user_id' => $_SESSION['user_id'],
            'content' => $this->input->post('content'),
            'created_at' => $today,
            'updated_at' => $today
        ];
        return $this->db->insert('tweets', $data);
    }

    public function getByTweetId($tweetId)
    {
        $this->db->select('name, content, tweets.created_at, tweets.id AS tweet_id');
        $this->db->where('tweets.id', $tweetId);
        $this->db->join('users', 'users.id = tweets.user_id', 'left');
        $query = $this->db->get('tweets');
        return $query->row_array();
    }

    public function deleteTweet($tweetId)
    {
        $today = date("Y-m-d H:i:s");

        $data = [
            'updated_at' => $today,
            'deleted_at' => $today
        ];

        return $this->db->where('id', $tweetId)->update('tweets', $data);
    }

    public function updateTweet($tweetId, $input)
    {
        $today = date("Y-m-d H:i:s");

        $data = [
            'content' => $input,
            'updated_at' => $today,
        ];

        return $this->db->where('id', $tweetId)->update('tweets', $data);
    }

    public function checkUserId($userId, $tweetId)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('id', $tweetId);
        return $this->db->get('tweets')->row_array();
    }

    public function getByUserId($userId)
    {
        $this->db->select('name, content, tweets.created_at, tweets.id AS tweet_id');
        $this->db->where('user_id', $userId);
        $this->db->where('tweets.deleted_at', NULL);
        $this->db->join('users', 'users.id = tweets.user_id', 'left');
        $query = $this->db->get('tweets');
        return $query->result_array();
    }
}
