<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function deleteMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Menu deleted!</div>');
    }

    public function getSubMenu()
    {
        $q = "SELECT `user_sub_menu`.*, `user_menu`.`menu` 
                FROM `user_sub_menu` JOIN `user_menu`
                ON  `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";

        return $this->db->query($q)->result_array();
    }

    public function getSubMenuById($id)
    {
        $q = "SELECT `user_sub_menu`.*, `user_menu`.`menu` 
                FROM `user_sub_menu` JOIN `user_menu`
                ON  `user_sub_menu`.`menu_id` = `user_menu`.`id`
                WHERE `user_sub_menu`.`id` = $id
                ";

        return $this->db->query($q)->row_array();
    }

    public function editMenu()
    {
        $data = [
            'menu' => $this->input->post('menu', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function editSubmenu()
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

    public function deleteSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Submenu deleted!</div>');
    }
}
