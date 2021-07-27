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
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|max_length[255]|valid_email', [
          'required' => '%sは必須です。',
          'max_length' => '{param}文字以内で入力してください。',
          'valid_email' => '%sの形式が誤っております。',
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
            'password' => $this->input->post('password', TRUE),
        ];

        if ($this->login_model->validate($input)) {
            $user = $this->login_model->get_by_email($input['email']);

            $ses_array = [
                'user_id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'logged_in' => TRUE,
            ];

            $this->session->set_userdata($ses_array);
            // 仮置きURL
            redirect('/');
        } else {
          echo $this->session->set_flashdata('msg','ログイン情報に誤りがあります。');
          redirect('/login');
        };
    }

    public function logout()
    {
      $this->session->sess_destroy();
      redirect('login');
    }
}