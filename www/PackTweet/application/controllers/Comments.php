<?php

class Comments extends CI_Controller
{
    public function __construct()
	  	{
	  			parent::__construct();
          $this->load->model('comment_model');
	  			$this->load->library('form_validation');
	  			$this->load->library('session');
          $this->load->helper('url');

          if(!$this->session->userdata('logged_in')){
              redirect('/register');
          }
	  	}

    public function create($tweet_id)
    {
        $this->form_validation->set_rules('content', '本文', 'required|max_length[140]', [
            'required' => '%sは必須です。',
            'max_length' => '{param}文字以内で入力してください。',
        ]);

        if (!$this->form_validation->run()) {
            $this->load->view('common/header');
            return $this->load->view('users/show_tweet');
        }

        $this->comment_model->create($tweet_id);
        redirect('tweets/' . $tweet_id);
    }
}