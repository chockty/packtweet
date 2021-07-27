<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') !== TRUE) {
            $this->load->view('common/header');
            $this->load->view('users/login');
        } else {
            // 仮置きURL
            redirect('/');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|max_length[255]|valid_email|is_unique[users.email]', [
          'required' => '%sは必須です。',
          'max_length' => '{param}文字以内で入力してください。',
          'valid_email' => '%sの形式が誤っております。',
          'is_unique' => '既に登録されている%sです。',
        ]);

        $this->form_validation->set_rules('password', 'パスワード', 'required|min_length[8]|max_length[50]', [
          'required' => '%sは必須です。',
          'min_length' => '{param}文字以上で入力してください。',
          'max_length' => '{param}文字以内で入力してください。',
        ]);

        if (!$this->form_validation->run()) {
          return $this->index();
        }

        $input = [
            'email' => $this->input->post('email', TRUE),
            'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
        ];

        $var = $this->login_model->validate();
        var_dump($var);
    }

    public function logout()
    {
      $this->session->sess_destroy();
      redirect('login');
    }
}