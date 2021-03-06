<?php defined('BASEPATH') or exit('No direct script access allowed');

class List_event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('m_kegiatan');
        $this->load->model('m_global');
        $this->load->model('M_foto');
        // $this->load->model('M_event');

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        // $this->load->model('foto_model');
        $this->data['title'] = 'KBMK | List Event';
    }

    /**
     * Redirect if needed, otherwise display the user list
     */
    public function index()
    {
        //jika mereka belum login
        if (!$this->ion_auth->logged_in()) {
            // alihkan mereka ke halaman login  
            redirect('auth/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();
        $id_group = $this->db->query('SELECT id_group FROM users_groups WHERE id_user = ' . $user->id_user . '')->row();
        $this->data['ip_address'] = $user->ip_address;
        $this->data['email'] = $user->email;
        $this->data['user_id'] = $user->id_user;
        date_default_timezone_set('Asia/Jakarta');
        $this->data['last_login'] =  date('d-m-Y H:i:s', $user->last_login);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['message_deaktivasi'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_deaktivasi');

        $this->data['isi'] = 'pengurus/list_event/index';
        $this->data['id_group'] = $id_group->id_group;
        $this->data['events'] = $this->db->query('SELECT id_event, title, start_event, end_event, color FROM events')->result_array();

        //jika mereka sudah login dan sebagai admin
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(1)) {
            $this->load->view('template/wrapper', $this->data);
        } else {
            // set the flash data error message if there is one
            $this->ion_auth->logout();
            $this->session->set_flashdata('message', 'Anda tidak memiliki otorisasi untuk mengakses sistem, silahkan hubungi admin');
        }
    }

    public function insert()
    {
        if (isset($_POST['title'])) {
            $data = array(
                'title'     => $this->input->post('title'),
                'color'     => $this->input->post('color'),
                'start_event' => $this->input->post('start'),
                'end_event'   => $this->input->post('end')
            );

            $this->db->insert('events', $data);
        }
        redirect('pengurus/list_event', 'refresh');
    }

    public function update()
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $this->db->delete('events', array('id_event', $_POST['id']));
        } else if (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])) {
            $data = array(
                'title'     => $this->input->post('title'),
                'color'     => $this->input->post('color'),
            );

            $this->db->where('id_event', $this->input->post('id'));
            $this->db->update('events', $data);
        }
        redirect('pengurus/list_event', 'refresh');
    }
}
