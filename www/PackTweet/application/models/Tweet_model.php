<?php

class Tweet_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_tweets()
    {
        $getRetweets = '(select tweet_id, retweet_user_id, name AS retweet_user_name, retweet_time from (select tweet_id, user_id AS retweet_user_id,  created_at AS retweet_time from retweet_tweet left outer join retweets on retweets.id = retweet_tweet.retweet_id) AS get_retweets_user left outer join users on users.id = get_retweets_user.retweet_user_id) AS get_retweets';

        $tweets = $this->db->select('name, retweet AS retweet_user_name, content, tweets.created_at, tweets.id AS tweet_id, retweet AS retweet_time, tweets.created_at AS order_time')
                           ->from('tweets')
                           ->where('tweets.deleted_at', NULL)
                           ->join('users', 'users.id = tweets.user_id')
                           ->get_compiled_select();
        $this->db->reset_query();
        $retweets = $this->db->select('name, retweet_user_name, content, tweets.created_at, tweets.id AS tweet_id, retweet_time, retweet_time AS order_time')
                             ->from('tweets')
                             ->where('tweets.deleted_at', NULL)
                             ->where('retweet', TRUE)
                             ->join('users', 'users.id = tweets.user_id')
                             ->join($getRetweets, 'get_retweets.tweet_id = tweets.id')
                             ->get_compiled_select();
        $this->db->reset_query();
        return $this->db->query("($tweets) UNION ($retweets) ORDER BY order_time DESC")->result_array();
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
        // $this->db->select('name, content, tweets.created_at, tweets.id AS tweet_id');
        // $this->db->where('user_id', $userId);
        // $this->db->where('tweets.deleted_at', NULL);
        // $this->db->order_by('tweets.created_at', 'DESC');
        // $this->db->join('users', 'users.id = tweets.user_id', 'left');
        // $query = $this->db->get('tweets');
        // return $query->result_array();

        $getRetweets = '(select tweet_id, retweet_user_id, name AS retweet_user_name, retweet_time from (select tweet_id, user_id AS retweet_user_id,  created_at AS retweet_time from retweet_tweet left outer join retweets on retweets.id = retweet_tweet.retweet_id) AS get_retweets_user left outer join users on users.id = get_retweets_user.retweet_user_id) AS get_retweets';

        $tweets = $this->db->select('name, retweet AS retweet_user_name, content, tweets.created_at, tweets.id AS tweet_id, retweet AS retweet_time, tweets.created_at AS order_time')
                           ->from('tweets')
                           ->where('tweets.deleted_at', NULL)
                           ->where('user_id', $userId)
                           ->join('users', 'users.id = tweets.user_id')
                           ->get_compiled_select();
        $this->db->reset_query();
        $retweets = $this->db->select('name, retweet_user_name, content, tweets.created_at, tweets.id AS tweet_id, retweet_time, retweet_time AS order_time')
                             ->from('tweets')
                             ->where('tweets.deleted_at', NULL)
                             ->where('retweet', TRUE)
                             ->where('retweet_user_id', $userId)
                             ->join('users', 'users.id = tweets.user_id')
                             ->join($getRetweets, 'get_retweets.tweet_id = tweets.id')
                             ->get_compiled_select();
        $this->db->reset_query();
        return $this->db->query("($tweets) UNION ($retweets) ORDER BY order_time DESC")->result_array();
    }
}
