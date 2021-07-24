<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function editProfile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $name = $this->input->post('name');
        $email = $this->input->post('email');

        //cek apakah ada image
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|svg';
            $config['max_size'] = '2048';
            $config['upload_path'] = 'assets/img/profile/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {

                $old_image = $data['user']['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('user');
            }
        }

        $this->db->set('name', $name);
        $this->db->where('email', $email);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile Updated!</div>');
        redirect('user');
    }
}
