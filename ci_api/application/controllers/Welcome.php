<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Welcome extends REST_Controller {

    public function index_get()
    {
        $id = $this->get('id');
        $username = $this->get('username');
        $alamat = $this->get('alamat');

        if (!$alamat == '' and !$username == '') {
            $data = array(
                'nama_user' => $username,
                'alamat' => $alamat
            );

            $user = $this->db->get_where('user', $data)->result();
        } elseif (!$id == '') {
            $this->db->where('id', $id);
            $user = $this->db->get('user')->result();
        } else {
            $user = $this->db->get('user')->result();
        }
        $this->response($user, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        $data = array(
            'id' => $this->post('id'),
            'nama_user' => $this->post('username'),
            'alamat' => $this->post('alamat')
        );

        $insert = $this->db->insert('user', $data);

        if ($insert) {
            $this->response(array('status' => 'success'));
        } else {
            $this->response(array('status' => 'fail'));
        }
        
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'nama_user' => $this->put('username'),
            'alamat' => $this->put('alamat')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response(array('status' => 'success'));
        } else {
            $this->response(array('status' => 'fail'));
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success'));
        } else {
            $this->response(array('status' => 'fail'));
        }
    }

}
