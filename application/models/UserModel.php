<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{
    protected $_table = 'User';
    protected $primary = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll()
    {
        return $this->db->where('is_active', 1)->get($this->_table)->result();
    }

    public function save()
    {
        $data = array(
            'nik' => htmlspecialchars($this->input->post('nik'), true),
            'username' => htmlspecialchars($this->input->post('username'), true),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => htmlspecialchars($this->input->post('email'), true),
            'full_name' => htmlspecialchars($this->input->post('full_name'), true),
            'phone' => htmlspecialchars($this->input->post('phone'), true),
            'alamat' => htmlspecialchars($this->input->post('alamat'), true),
            'role' => htmlspecialchars($this->input->post('role'), true),
            'is_active' => 1,
        );

        return $this->db->insert($this->_table, $data);
    }
    public function getById($id)
    {
        return $this->db->where($this->primary, $id)->get($this->_table)->row();
    }
    public function editData()
{
    $id = $this->input->post('id');

    $data = array(
        'username' => htmlspecialchars($this->input->post('username'), true),
        'email' => htmlspecialchars($this->input->post('email'), true),
        'full_name' => htmlspecialchars($this->input->post('full_name'), true),
        'phone' => htmlspecialchars($this->input->post('phone'), true),
        'role' => htmlspecialchars($this->input->post('role'), true),
        'is_active' => 1
    );

    // Memastikan password hanya diupdate jika diisi
    if (!empty($this->input->post('password'))) {
        $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
    }

    return $this->db->set($data)->where($this->primary, $id)->update($this->_table);
}
public function delete($id)
{
    // Menghapus data berdasarkan ID
    $this->db->where('id', $id)->delete($this->_table);

    if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata("success", "Data user berhasil dihapus");
    } else {
        $this->session->set_flashdata("error", "Data user gagal dihapus atau tidak ditemukan");
    }

    redirect('user');
}

}
