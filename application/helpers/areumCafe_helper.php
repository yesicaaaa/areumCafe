<?php

function is_logged_in_admin()
{
  $ci = get_instance(); 
  if (!$ci->session->userdata('email')) {
    redirect('main/signIn');
  } else {
    $hak_akses = $ci->session->userdata('hak_akses');
    $access = $ci->db->get_where('user', ['hak_akses' => $hak_akses])->row_array();

    if ($access['hak_akses'] == 2) {
      redirect('main/blockedCashier');
    } else if ($access['hak_akses'] == 3) {
      redirect('main/blockedWaiter');
    }
  }
}

function is_logged_in_cashier()
{
  $ci = get_instance(); 
  if (!$ci->session->userdata('email')) {
    redirect('main/signIn');
  } else {
    $hak_akses = $ci->session->userdata('hak_akses');
    $access = $ci->db->get_where('user', ['hak_akses' => $hak_akses])->row_array();

    if ($access['hak_akses'] == 1) {
      redirect('main/blockedAdmin');
    } else if ($access['hak_akses'] == 3) {
      redirect('main/blockedWaiter');
    }
  }
}

function is_logged_in_waiter()
{
  $ci = get_instance();
  if (!$ci->session->userdata('email')) {
    redirect('main/signIn');
  } else {
    $hak_akses = $ci->session->userdata('hak_akses');
    $access = $ci->db->get_where('user', ['hak_akses' => $hak_akses])->row_array();

    if ($access['hak_akses'] == 1) {
      redirect('main/blockedAdmin');
    } else if ($access['hak_akses'] == 2) {
      redirect('main/blockedCashier');
    }
  }
}

function isset_pelanggan()
{
  $ci = get_instance();
  if(!$ci->session->userdata('id_pelanggan') && !$ci->session->userdata('email')){
    redirect('main/signIn');
  }else {
    $hak_akses = $ci->session->userdata('hak_akses');
    $access = $ci->db->get_where('user', ['hak_akses' => $hak_akses])->row_array();
    
    if ($access['hak_akses'] == 2 && !$ci->session->userdata('id_pelanggan')) {
      redirect('main/blockedCashier');
    } else if ($access['hak_akses'] == 3 && !$ci->session->userdata('id_pelanggan')) {
      redirect('main/blockedWaiter');
    } else if($access['hak_akses'] == 1 && !$ci->session->userdata('id_pelanggan')) {
      redirect('main/blockedAdmin');
    }
  }
}