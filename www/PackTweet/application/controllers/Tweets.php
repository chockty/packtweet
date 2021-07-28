<?php

class Tweets extends CI_Controller
{
		public function __construct()
		{
				parent::__construct();
				$this->load->model('tweet_model');
				$this->load->library('form_validation');
				$this->load->library('session');
        $this->load->helper('url');

        // if(!$this->session->userdata('logged_in')){
        //     redirect('/register');
        // }
		}

		public function index()
		{
				$data['tweets'] = $this->tweet_model->get_all_tweets();
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

        if (!$this->form_validation->run()) {
						$this->load->view('common/header');
            return $this->load->view('users/create_tweet');
        }

				$this->tweet_model->createTweet();
				// todo:redirect先修正する
        redirect('/');
		}

		public function show($tweetId)
		{
				$data['tweet'] = $this->tweet_model->getByTweetId($tweetId);
				$this->load->view('common/header');
				$this->load->view('users/show_tweet', $data);
		}

		public function delete($tweetId)
		{
				$this->tweet_model->deleteTweet($tweetId);
				// todo:redirect先修正する
				redirect('/');
		}
}
