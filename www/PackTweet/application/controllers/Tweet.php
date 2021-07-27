<?php

class Tweet extends CI_Controller
{
		public function __construct()
		{
				parent::__construct();
				$this->load->model('tweet_model');
				$this->load->library('form_validation');
				$this->load->library('session');
        $this->load->helper('url');

        if(!$this->session->userdata('logged_in')){
            redirect('/register');
        }
		}

		public function create()
		{
				$this->load->view('users/create_tweet');
		}

		public function store()
		{
        $this->form_validation->set_rules('content', 'ツイート', 'required|max_length[140]', [
          'required' => '%sは必須です。',
          'max_length' => '{param}文字以内で入力してください。',
        ]);

        if (!$this->form_validation->run()) {
            return $this->load->view('users/create_tweet');
        }

        $this->tweet_model->createTweet();
        redirect('/');
		}

}
