<?php

class Tweet_model extends CI_Model
{
		public function __construct()
		{
				$this->load->database();
		}

    public function get_all_tweets()
    {
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

        $data = array(
            'updated_at' => $today,
            'deleted_at' => $today
        );

        return $this->db->where('id', $tweetId)->update('tweets', $data);
		}
}
