<?php

class Tweets extends CI_Controller
{
		public function __construct()
		{
				parent::__construct();
				$this->load->model('tweet_model');
        $this->load->model('favorite_model');
				$this->load->library('form_validation');
				$this->load->library('session');
        $this->load->helper('url');

        if(!$this->session->userdata('logged_in')){
            redirect('/register');
        }
		}

		public function index()
		{
				$data['tweets'] = $this->tweet_model->get_all_tweets($this->input->get('search_word', TRUE));
				$data['search_word'] = $this->input->get('search_word', TRUE);
				$this->load->view('common/header');
				$this->load->view('common/sidebar');
				$this->load->view('users/index_tweet', $data);
		}

		public function create()
		{
				$this->load->view('common/header');
				$this->load->view('users/create_tweet');
		}

		public function store()
		{
            $this->form_validation->set_rules('content', 'ツイート', 'required|max_length[140]', [
                'required' => '%sは必須です。',
                'max_length' => '{param}文字以内で入力してください。',
            ]);

            $urlArray = parse_url($_SERVER['HTTP_REFERER']);

            if (!$this->form_validation->run()) {
                if ($urlArray['path'] === '/tweets/create') {
                    $this->load->view('common/header');
                    return $this->load->view('users/create_tweet');
                } else {
                    return $this->index();
                }
            }

            $this->tweet_model->createTweet();
            redirect('/');
		}

		public function show($tweetId)
		{
				$this->load->model('comment_model');
				$data['tweet'] = $this->tweet_model->getByTweetId($tweetId);
                $data['comments'] = $this->comment_model->get_by_tweet_id($tweetId);
				$this->load->view('common/header');
				$this->load->view('common/sidebar');
				$this->load->view('users/show_tweet', $data);
		}

		public function delete($tweetId)
		{
				$this->tweet_model->deleteTweet($tweetId);
				redirect('/');
		}

		public function edit($tweetId)
		{
				if (!$this->tweet_model->checkUserId($_SESSION['user_id'], $tweetId)) {
						redirect('/');
				}

				$data['tweet'] = $this->tweet_model->getByTweetId($tweetId);
				$this->load->view('common/header');
				$this->load->view('users/edit_tweet', $data);
		}

		public function update($tweetId)
		{
				if (!$this->tweet_model->checkUserId($_SESSION['user_id'], $tweetId)) {
						redirect('/');
				}
				$data['tweet'] = $this->tweet_model->getByTweetId($tweetId);
				$this->form_validation->set_rules('content', 'ツイート', 'required|max_length[140]', [
						'required' => '%sは必須です。',
						'max_length' => '{param}文字以内で入力してください。',
				]);
        if (!$this->form_validation->run()) {
						$this->load->view('common/header');
						return $this->load->view('users/edit_tweet', $data);
				}
				$input = $this->input->post('content');
				$this->tweet_model->updateTweet($tweetId, $input);
				redirect('/');
		}

		public function mypage()
		{
            $userId = $_SESSION['user_id'];
            $data['tweets'] = $this->tweet_model->getByUserId($userId);
            $data['favorites'] = $this->favorite_model->getByUserId($userId);
            $this->load->view('common/header');
            $this->load->view('common/sidebar');
            $this->load->view('users/mypage', $data);
		}

    public function favorite()
    {
        $user_id = $_SESSION['user_id'];
        $tweet_id = $this->input->post('tweet_id');

        if ($this->favorite_model->is_exists($user_id, $tweet_id)) {
            $this->favorite_model->delete($user_id, $tweet_id);
            redirect('tweets/' . $tweet_id);
        } else {
            $this->favorite_model->create($user_id, $tweet_id);
            redirect('tweets/' . $tweet_id);
        }
    }

    public function retweet($tweetId)
    {
        $userId = $_SESSION['user_id'];
        $this->tweet_model->createRetweet($tweetId, $userId);
        redirect('/');
    }
}
