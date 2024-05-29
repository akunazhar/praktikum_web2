<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

            $this->load->view('login/index');
       
    }

    public function dologin() {
        $user = $this->input->post('email');
        $pswd = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $user])->row_array();

        if ($user) { 
            // jika user terdaftar
            if (password_verify($pswd, $user['password'])) { 
                // periksa password-nya
                $data = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];

                $userid = $user['id'];
                $this->session->set_userdata($data);

                if ($user['role'] == 'owner') { 
                    // periksa role-nya
                    $this->_updateLastLogin($userid);
                    redirect('user');
                } else if ($user['role'] == 'manajer') {
                    $this->_updateLastLogin($userid);
                    redirect('user');
                } else if ($user['role'] == 'staff') {
                    $this->_updateLastLogin($userid);
                    redirect('user');
                } else if ($user['role'] == 'kasir') {
                    $this->_updateLastLogin($userid);
                    redirect('user'); 
                } else {
                    redirect('login');
                }
            } else { 
                // jika password salah
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> <b>Error :</b> Password Salah. </div>');
                redirect('login');
            }
        } else { 
            // Jika user tidak terdaftar
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> <b>Error :</b> User Tidak Terdaftar. </div>');
            redirect('login');
        }
    }
    public function logout() {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }

    public function block() {
        $data = array(
             // Pastikan fungsi infoLogin() terdefinisi
            'title' => 'Access Denied!'
        );
        $this->load->view('login/error404', $data);
    }
    private function _updateLastLogin($userid) {
        $sql = "UPDATE user SET last_login=now() WHERE id=$userid";
        $this->db->query($sql);
    }

    
}
