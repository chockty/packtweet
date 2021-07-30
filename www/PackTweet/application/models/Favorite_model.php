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

    public function getByUserId($userId)
    {
        $getTweets = '(select tweets.id, content, tweets.created_at ,name from tweets left outer join users on users.id = tweets.user_id)';

        $this->db->select('user_id AS favorite_user_id, name, content, tweets_users.created_at AS tweet_time, favorites.created_at AS favorite_time, favorites.tweet_id');
        $this->db->where('favorites.user_id', $userId);
        $this->db->join($getTweets . ' AS tweets_users', 'tweets_users.id = favorites.tweet_id', 'left');
        $this->db->order_by('favorite_time', 'desc');
        $query = $this->db->get('favorites');
        return $query->result_array();
    }
}