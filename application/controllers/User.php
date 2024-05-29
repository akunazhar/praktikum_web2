<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // Memuat model UserModel
        $this->load->model("UserModel"); // Pastikan nama model sesuai dengan nama file model yang sebenarnya
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'title' => 'View Data User',
            'user' => $this->UserModel->getAll(),
            'content' => 'user/index'
        );
        $this->load->view('template/main', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Tambah Data User',
            'content' => 'user/add_form'
        );
        $this->load->view('template/main', $data);
    }

    public function save()
    {
        // Atur aturan validasi form
        $this->UserModel->save();
         if($this->db->affected_rows()>0){
         $this->session->set_flashdata("success", "Data user Berhasil DiSimpan");
        }   
    }
    public function getedit($id)
    {
        $data = array(
            'title' => 'Update Data User',
            'user' => $this->UserModel->getById($id),
            'content' => 'user/edit_form'
        );

        $this->load->view('template/main', $data);
    }
    public function edit()
{
    // Validasi form
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('full_name', 'Full Name', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');
    $this->form_validation->set_rules('role', 'Role', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, kembalikan ke form dengan pesan kesalahan
        $this->getedit($this->input->post('id'));
    } else {
        // Panggil metode model untuk mengupdate data
        $this->UserModel->editData();

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata("success", "Data user berhasil diupdate");
        } else {
            $this->session->set_flashdata("error", "Data user gagal diupdate atau tidak ada perubahan data");
        }

        redirect('user');
    }
    }
    function delete($id)

    {
    $this->UserModel->delete($id);
    redirect('user');
    }
    
}
