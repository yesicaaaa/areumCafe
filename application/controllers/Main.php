<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
  function signIn()
  {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if($this->form_validation->run() == false){
      $data = [
        'title' => 'Masuk | Areum Cafe',
        'css'   => 'sign.css',
        'js'
      ];
      $this->load->view('templates/header', $data);
      $this->load->view('user/signin');
      $this->load->view('templates/footer', $data);
    }else{
      $password = $this->input->post('password');
      $email = $this->input->post('email');
      $user = $this->db->get_where('user', ['email' => $email])->row_array();
      if($user){
        if(password_verify($password, $user['password'])){
          $data = [
            'id_user' => $user['id_user'],
            'email' => $email,
            'nama'  => $user['nama'],
            'hak_akses' => $user['hak_akses']
          ];
          $this->session->set_userdata($data);
          if($user['hak_akses'] == 1){
            redirect('admin');
          }elseif($user['hak_akses'] == 2){
            redirect('cashier');
          }else{
            redirect('waiter');
          }
        }else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
          redirect('main/signIn');
        }
      }else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
        redirect('main/signIn');
      }
    }
  }

  function signUp()
  {
    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
    
    if($this->form_validation->run() == false) {
      $data = [
        'title' => 'Daftar | Areum Cafe',
        'css'   => 'sign.css',
        'js'    => 'signup.js'
      ];
      $this->load->view('templates/header', $data);
      $this->load->view('user/signup');
      $this->load->view('templates/footer', $data);
    }else{
      $data = [
        'nama'  => htmlspecialchars($this->input->post('nama')),
        'email' => htmlspecialchars($this->input->post('email')),
        'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'hak_akses' => 3,
        'date_created'  => date('Y-m-d')
      ];

      $this->db->insert('user', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat. Silahkan Signin.</div>');
      redirect('main/signIn');
    }
  }

  function signout()
  {
    $this->session->unset_userdata('');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil keluar akun</div>');
    redirect('main/signIn');
  }
}

?>