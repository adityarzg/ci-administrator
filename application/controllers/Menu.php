<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->Menu_model->getSubMenu();

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('menu_id', 'menu', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function deletemenu($id)
    {
        $this->Menu_model->deleteMenu($id);
        redirect('menu');
    }

    public function editmenu($id)
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

        $this->form_validation->set_rules('menu', 'menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Menu_model->editMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu edited!</div>');
            redirect('menu');
        }
    }

    public function editsubmenu($id)
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenuById'] = $this->Menu_model->getSubMenuById($id);

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('menu_id', 'menu', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editsubmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Menu_model->editSubmenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu edited!</div>');
            redirect('menu/submenu');
        }
    }

    public function deletesubmenu($id)
    {
        $this->Menu_model->deleteSubMenu($id);
        redirect('menu/submenu');
    }
}
