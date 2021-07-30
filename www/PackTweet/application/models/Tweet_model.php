<?php

class Tweet_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_tweets($search_word = '*')
    {
        $getRetweets = '(select tweet_id, retweet_user_id, name AS retweet_or_not, retweet_time from (select tweet_id, user_id AS retweet_user_id, created_at AS retweet_time from retweet_tweet left outer join retweets on retweets.id = retweet_tweet.retweet_id) AS get_retweets_user left outer join users on users.id = get_retweets_user.retweet_user_id) AS get_retweets';

        $tweets = $this->db->select('name, retweet AS retweet_or_not, content, tweets.created_at, tweets.id AS tweet_id, tweets.created_at AS tweet_created_orde')
                           ->from('tweets')
                           ->like('content', $search_word)
                           ->where('tweets.deleted_at', NULL)
                           ->join('users', 'users.id = tweets.user_id')
                           ->get_compiled_select();
        $this->db->reset_query();
        $retweets = $this->db->select('name, retweet_or_not, content, tweets.created_at, tweets.id AS tweet_id, retweet_time AS tweet_created_orde')
                             ->from('tweets')
                             ->like('content', $search_word)
                             ->where('tweets.deleted_at', NULL)
                             ->where('retweet', TRUE)
                             ->join('users', 'users.id = tweets.user_id')
                             ->join($getRetweets, 'get_retweets.tweet_id = tweets.id')
                             ->get_compiled_select();
        $this->db->reset_query();
        return $this->db->query("($tweets) UNION ($retweets) ORDER BY tweet_created_orde DESC")->result_array();
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
        $getRetweets = '(select tweet_id, count(*) AS retweet_count from retweet_tweet left outer join retweets on retweets.id = retweet_tweet.retweet_id group by tweet_id) AS retweet_counts';

        $this->db->select('name, content, tweets.created_at, tweets.id AS tweet_id, retweet_count');
        $this->db->where('tweets.id', $tweetId);
        $this->db->join('users', 'users.id = tweets.user_id', 'left');
        $this->db->join($getRetweets, 'retweet_counts.tweet_id = tweets.id', 'left');
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
        $getRetweets = '(select tweet_id, retweet_user_id, name AS retweet_or_not, retweet_time from (select tweet_id, user_id AS retweet_user_id, created_at AS retweet_time from retweet_tweet left outer join retweets on retweets.id = retweet_tweet.retweet_id) AS get_retweets_user left outer join users on users.id = get_retweets_user.retweet_user_id) AS get_retweets';

        $tweets = $this->db->select('name, retweet AS retweet_or_not, content, tweets.created_at, tweets.id AS tweet_id, tweets.created_at AS tweet_created_orde')
                           ->from('tweets')
                           ->where('tweets.deleted_at', NULL)
                           ->where('user_id', $userId)
                           ->join('users', 'users.id = tweets.user_id')
                           ->get_compiled_select();
        $this->db->reset_query();
        $retweets = $this->db->select('name, retweet_or_not, content, tweets.created_at, tweets.id AS tweet_id, retweet_time AS tweet_created_orde')
                             ->from('tweets')
                             ->where('tweets.deleted_at', NULL)
                             ->where('retweet', TRUE)
                             ->where('retweet_user_id', $userId)
                             ->join('users', 'users.id = tweets.user_id')
                             ->join($getRetweets, 'get_retweets.tweet_id = tweets.id')
                             ->get_compiled_select();
        $this->db->reset_query();
        return $this->db->query("($tweets) UNION ($retweets) ORDER BY tweet_created_orde DESC")->result_array();
    }

    public function createRetweet($tweetId, $userId)
    {
        $today = date('Y-m-d H:i:s');

        $data = [
            'retweet' => TRUE,
            'updated_at' => $today,
        ];
        $this->db->where('id', $tweetId)->update('tweets', $data);

        $data = [
            'user_id' => $userId,
            'created_at' => $today,
            'updated_at' => $today,
        ];
        $this->db->insert('retweets', $data);
        $retweetId = $this->db->insert_id();

        $data = [
            'retweet_id' => $retweetId,
            'tweet_id' => $tweetId,
        ];
        return $this->db->insert('retweet_tweet', $data);
    }
}
