<?php defined('BASEPATH') or exit('No direct script access allowed');

class List_anggota extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->helper('my_date_helper');
        $this->load->model('m_anggota');
        $this->load->model('m_global');
        $this->load->model('M_foto');

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        // $this->load->model('foto_model');
        $this->data['title'] = 'KBMK | List Anggota';
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

        $this->data['isi'] = 'pengurus/list_anggota/index';
        $this->data['id_group'] = $id_group->id_group;

        //jika mereka sudah login dan sebagai admin
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(1)) {
            $this->load->view('template/wrapper', $this->data);
        } else {
            // set the flash data error message if there is one
            $this->ion_auth->logout();
            $this->session->set_flashdata('message', 'Anda tidak memiliki otorisasi untuk mengakses sistem, silahkan hubungi admin');
        }
    }

    public function user_log($KETERANGAN)
    {

        $user = $this->ion_auth->user()->row();
        $WAKTU = date('Y-m-d H:i:s');
        $this->m_anggota->user_log_anggota($user->id_mhs, $KETERANGAN, $WAKTU);
    }

    public function logout()
    {

        $user = $this->ion_auth->user()->row();
        $KETERANGAN = "Paksa Logout Ketika Akses Anggota";
        $WAKTU = date('Y-m-d H:i:s');
        $this->m_anggota->user_log_anggota($user->id_mhs, $KETERANGAN, $WAKTU);

        $this->ion_auth->logout();

        // set the flash data error message if there is one
        $this->session->set_flashdata('message', 'Anda tidak memiliki otorisasi untuk mengakses sistem, silahkan hubungi admin');
    }

    public function cek_edit()
    {
        $id     = $this->input->post('id');

        $query['select'] = 'a.*';
        $query['table']  = 'mahasiswa a';
        $query['where']  = 'a.id_mhs = ' . $id;

        if (isset($id)) {
            $cek                                = $this->m_global->getRow($query);
            echo json_encode($cek);
        } else {
            $this->session->set_flashdata('pesan_gagal', 'Id tidak boleh kosong');
            redirect('pengurus/list_anggota');
        }
    }

    public function proses()
    {
        if ($this->ion_auth->logged_in() && ($this->ion_auth->in_group(1))) {
            $user = $this->ion_auth->user()->row();
            $status                = true;
            $nama_lengkap             = $this->input->post('nama_lengkap');
            $npm        = $this->input->post('npm');
            $ttl                 = $this->input->post('ttl');
            $no_hp                 = $this->input->post('no_hp');
            $alamat                 = $this->input->post('alamat');
            $email             = $this->input->post('email');



            $this->_validate();
            if ($this->m_anggota->cek_nama_anggota($nama_lengkap) == 'BELUM ADA NAMA ANGGOTA') {

                $data = array(
                    'nama'                => $nama_lengkap,
                    'npm'             => $npm,
                    'tempat_tgl_lahir'                     => $ttl,
                    'no_hp'                         => $no_hp,
                    'alamat'               => $alamat,
                    'email'            => $email,
                    'active'            => 1,
                );

                $KETERANGAN = "Simpan Anggota: "
                    . "; " . $nama_lengkap
                    . "; " . $npm
                    . "; " . $ttl
                    . "; " . $no_hp
                    . "; " . $alamat
                    . "; " . $email;
                $this->user_log($KETERANGAN);
            } else {
                echo 'Nama Anggota sudah terekam/ada sebelumnya';
            }
        } else {
            $this->logout();
        }

        $this->db->insert('mahasiswa', $data);
        echo json_encode(['status' => $status]);
    }

    public function update()
    {
        if ($this->ion_auth->logged_in() && ($this->ion_auth->in_group(1))) {
            $status                = true;
            $status                = true;
            $nama_lengkap             = $this->input->post('nama_lengkap_');
            $npm        = $this->input->post('npm_');
            $ttl                 = $this->input->post('ttl_');
            $no_hp                 = $this->input->post('no_hp_');
            $alamat                 = $this->input->post('alamat_');
            $email             = $this->input->post('email_');

            $id     = $this->input->post('id_mhs');

            $query['select'] = 'a.*';
            $query['table']  = 'mahasiswa a';
            $query['where']  = 'a.id_mhs = ' . $id;

            $cek                                = $this->m_global->getRow($query);

            $this->_validates();

            $data = array(
                'nama'                => $nama_lengkap,
                'npm'             => $npm,
                'tempat_tgl_lahir'                     => $ttl,
                'no_hp'                         => $no_hp,
                'alamat'               => $alamat,
                'email'            => $email,
            );

            $KETERANGAN = "Ubah Data Anggota: " . json_encode($cek) . " ---- " . $nama_lengkap . ";" . $npm . ";" . $ttl . ";" . $no_hp . ";" . $alamat . ";" . $email;

            $this->user_log($KETERANGAN);
        } else {
            $this->logout();
        }

        $this->db->where('id_mhs', $id);
        $this->db->update('mahasiswa', $data);
        echo json_encode(['status' => $status]);
    }

    private function _validate()
    {
        $data = [];

        $nama_lengkap             = $this->input->post('nama_lengkap');
        $npm        = $this->input->post('npm');
        $ttl                 = $this->input->post('ttl');
        $no_hp                 = $this->input->post('no_hp');
        $alamat                 = $this->input->post('alamat');
        $email             = $this->input->post('email');


        $data['error_class']  = [];
        $data['error_string'] = [];
        $data['status']       = true;

        if ($nama_lengkap == '') {
            $data['error_class']['nama_lengkap']  = 'is-invalid';
            $data['error_string']['nama_lengkap'] = 'Nama Lengkap tidak boleh kosong';
            $data['status']                        = false;
        }

        if ($npm == '') {
            $data['error_class']['npm']  = 'is-invalid';
            $data['error_string']['npm'] = 'NPM tidak boleh kosong';
            $data['status']                = false;
        }

        if ($ttl == '') {
            $data['error_class']['ttl']  = 'is-invalid';
            $data['error_string']['ttl'] = 'Tempat Tanggal Lahir tidak boleh kosong';
            $data['status']                = false;
        }

        if ($no_hp == '') {
            $data['error_class']['no_hp']  = 'is-invalid';
            $data['error_string']['no_hp'] = 'Nomor Handphone tidak boleh kosong';
            $data['status']                         = false;
        }

        if ($alamat == '') {
            $data['error_class']['alamat']  = 'is-invalid';
            $data['error_string']['alamat'] = 'Alamat tidak boleh kosong';
            $data['status']                              = false;
        }

        if ($email == '') {
            $data['error_class']['email']  = 'is-invalid';
            $data['error_string']['email'] = 'Email tidak boleh kosong';
            $data['status']                         = false;
        }

        if ($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

    private function _validates()
    {
        $data = [];

        $nama_lengkap             = $this->input->post('nama_lengkap_');
        $npm        = $this->input->post('npm_');
        $ttl                 = $this->input->post('ttl_');
        $no_hp                 = $this->input->post('no_hp_');
        $alamat                 = $this->input->post('alamat_');
        $email             = $this->input->post('email_');


        $data['error_class']  = [];
        $data['error_string'] = [];
        $data['status']       = true;

        if ($nama_lengkap == '') {
            $data['error_class']['nama_lengkap_']  = 'is-invalid';
            $data['error_string']['nama_lengkap_'] = 'Nama Lengkap tidak boleh kosong';
            $data['status']                         = false;
        }

        if ($npm == '') {
            $data['error_class']['npm_']  = 'is-invalid';
            $data['error_string']['npm_'] = 'NPM tidak boleh kosong';
            $data['status']                = false;
        }

        if ($ttl == '') {
            $data['error_class']['ttl_']  = 'is-invalid';
            $data['error_string']['ttl_'] = 'Tempat Tanggal Lahir tidak boleh kosong';
            $data['status']                = false;
        }

        if ($no_hp == '') {
            $data['error_class']['no_hp_']  = 'is-invalid';
            $data['error_string']['no_hp_'] = 'Nomor Handphone tidak boleh kosong';
            $data['status']                         = false;
        }

        if ($alamat == '') {
            $data['error_class']['alamat_']  = 'is-invalid';
            $data['error_string']['alamat_'] = 'Alamat tidak boleh kosong';
            $data['status']                              = false;
        }

        if ($email == '') {
            $data['error_class']['email_']  = 'is-invalid';
            $data['error_string']['email_'] = 'Email tidak boleh kosong';
            $data['status']                          = false;
        }

        if ($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

    public function hapus_anggota()
    {
        $post   = $this->input->post();
        $where  = array('id_mhs' => $post['id']);
        $status = true;

        $this->db->where($where);
        $this->db->delete('mahasiswa');

        echo json_encode(['status' => $status]);
    }

    public function detail()
    {
        //jika mereka belum login
        if (!$this->ion_auth->logged_in()) {
            // alihkan mereka ke halaman login
            redirect('auth/login', 'refresh');
        }

        //get data tabel users untuk ditampilkan
        $user = $this->ion_auth->user()->row();
        $id_group = $this->db->query('SELECT id_group FROM users_groups WHERE id_user = ' . $user->id_user . '')->row();

        $this->data['USER_ID'] = $user->id_user;
        $this->data['id_mhs'] = $user->id_mhs;
        // $data_role_user = $this->Manajemen_user_model->get_data_role_user_by_id($this->data['USER_ID']);
        $this->data['role_user'] = 'pengurus';
        $this->data['ip_address'] = $user->ip_address;
        $this->data['email'] = $user->email;
        date_default_timezone_set('Asia/Jakarta');
        $this->data['last_login'] =  date('d-m-Y H:i:s', $user->last_login);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['message_deaktivasi'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_deaktivasi');
        $this->data['isi'] = 'pengurus/list_anggota/detail';
        $this->data['id_group'] = $id_group->id_group;

        $query_foto_user = $this->M_foto->get_data_by_id_mhs($user->id_mhs);
        if ($query_foto_user == "BELUM ADA FOTO") {
            $this->data['foto_user'] = "assets/img/profile_small.jpg";
        } else {
            $this->data['foto_user'] = $query_foto_user['KETERANGAN_2'];
        }

        $this->data['id_mhs'] = $this->uri->segment(4);

        //Kueri data di tabel pengurus
        $query_detil_anggota = $this->m_anggota->get_detil($this->data['id_mhs']);

        $query_detil_anggota_result = $this->m_anggota->get_detil_result($this->data['id_mhs']);
        $this->data['query_detil_anggota_result'] = $query_detil_anggota_result;

        if ($query_detil_anggota->num_rows() == 0) {
            // alihkan mereka ke halaman list pengurus
            redirect('pengurus/list_anggota', 'refresh');
        }
        //Kueri data di tabel anggota file
        $query_file_id_mhs = $this->m_anggota->file_list_by_id_mhs($this->data['id_mhs']);

        //log
        $KETERANGAN = "Lihat Profil Anggota: " . json_encode($query_detil_anggota_result) . " ---- " . json_encode($query_file_id_mhs);
        $this->user_log($KETERANGAN);

        $hasil_1 = $query_detil_anggota->row();
        $this->data['id_mhs'] = $hasil_1->id_mhs;
        $sess_data['id_mhs'] = $this->data['id_mhs'];
        $this->session->set_userdata($sess_data);

        if ($query_file_id_mhs->num_rows() > 0) {

            $this->data['dokumen'] = $this->m_anggota->file_list_by_id_mhs_result($this->data['id_mhs']);

            $hasil = $query_file_id_mhs->row();
            $DOK_FILE = $hasil->dok_file;
            $TANGGAL_UPLOAD = $hasil->tanggal_upload;

            if (file_exists($file = './assets/uploads/anggota/' . $DOK_FILE)) {
                $this->data['DOK_FILE'] = $DOK_FILE;
                $this->data['TANGGAL_UPLOAD'] = $TANGGAL_UPLOAD;
                $this->data['FILE'] = "ADA";
            }
        } else {
            $this->data['FILE'] = "TIDAK ADA";
        }

        //jika mereka sudah login dan sebagai admin
        if ($this->ion_auth->in_group(1)) {

            $this->load->view('template/wrapper', $this->data);
        } else {
            $this->logout();
        }
    }

    public function detail_upload()
    {
        //jika mereka belum login
        if (!$this->ion_auth->logged_in()) {
            // alihkan mereka ke halaman login
            redirect('auth/login', 'refresh');
        }

        //get data tabel users untuk ditampilkan
        $user = $this->ion_auth->user()->row();
        $id_group = $this->db->query('SELECT id_group FROM users_groups WHERE id_user = ' . $user->id_user . '')->row();

        $this->data['USER_ID'] = $user->id_user;
        $this->data['id_mhs'] = $user->id_mhs;
        // $data_role_user = $this->Manajemen_user_model->get_data_role_user_by_id($this->data['USER_ID']);
        $this->data['role_user'] = 'pengurus';
        $this->data['ip_address'] = $user->ip_address;
        $this->data['email'] = $user->email;
        date_default_timezone_set('Asia/Jakarta');
        $this->data['last_login'] =  date('d-m-Y H:i:s', $user->last_login);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['message_deaktivasi'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_deaktivasi');
        $this->data['isi'] = 'pengurus/list_anggota/upload';
        $this->data['id_group'] = $id_group->id_group;

        $query_foto_user = $this->M_foto->get_data_by_id_mhs($user->id_mhs);
        if ($query_foto_user == "BELUM ADA FOTO") {
            $this->data['foto_user'] = "assets/img/profile_small.jpg";
        } else {
            $this->data['foto_user'] = $query_foto_user['KETERANGAN_2'];
        }

        $this->data['id_mhs'] = $this->uri->segment(4);

        //Kueri data di tabel pengurus
        $query_detil_anggota = $this->m_anggota->get_detil($this->data['id_mhs']);

        $query_detil_anggota_result = $this->m_anggota->get_detil_result($this->data['id_mhs']);
        $this->data['query_detil_anggota_result'] = $query_detil_anggota_result;

        if ($query_detil_anggota->num_rows() == 0) {
            // alihkan mereka ke halaman list pengurus
            redirect('pengurus/list_anggota', 'refresh');
        }
        //Kueri data di tabel anggota file
        $query_file_id_mhs = $this->m_anggota->file_list_by_id_mhs($this->data['id_mhs']);

        //log
        $KETERANGAN = "Upload Sertifikat Anggota: " . json_encode($query_detil_anggota_result) . " ---- " . json_encode($query_file_id_mhs);
        $this->user_log($KETERANGAN);

        $hasil_1 = $query_detil_anggota->row();
        $this->data['id_mhs'] = $hasil_1->id_mhs;
        $sess_data['id_mhs'] = $this->data['id_mhs'];
        $this->session->set_userdata($sess_data);

        if ($query_file_id_mhs->num_rows() > 0) {

            $this->data['dokumen'] = $this->m_anggota->file_list_by_id_mhs_result($this->data['id_mhs']);

            $hasil = $query_file_id_mhs->row();
            $DOK_FILE = $hasil->dok_file;
            $TANGGAL_UPLOAD = $hasil->tanggal_upload;

            if (file_exists($file = './assets/uploads/anggota/' . $DOK_FILE)) {
                $this->data['DOK_FILE'] = $DOK_FILE;
                $this->data['TANGGAL_UPLOAD'] = $TANGGAL_UPLOAD;
                $this->data['FILE'] = "ADA";
            }
        } else {
            $this->data['FILE'] = "TIDAK ADA";
        }

        //jika mereka sudah login dan sebagai admin
        if ($this->ion_auth->in_group(1)) {

            $this->load->view('template/wrapper', $this->data);
        } else {
            $this->logout();
        }
    }


    public function cek_detail()
    {
        $id     = $this->input->post('id');

        $query['select'] = 'a.*';
        $query['table']  = 'mahasiswa a';
        $query['where']  = 'a.id_mhs = ' . $id;

        if (isset($id)) {
            $cek                                = $this->m_global->getRow($query);
            echo json_encode($cek);
        } else {
            $this->session->set_flashdata('pesan_gagal', 'Id tidak boleh kosong');
            redirect('pengurus/list_anggota');
        }
    }

    public function verif()
    {
        if ($this->ion_auth->logged_in() && ($this->ion_auth->in_group(1))) {

            $status                = true;
            $user = $this->ion_auth->user()->row();

            $id_mhs = $this->input->post('id_mhs');

            $pengajuan = $this->db->query("SELECT * FROM form_pengajuan 
            WHERE id_mhs = '$id_mhs'")->row();

            if ($pengajuan) {
                $nama_lengkap             = $pengajuan->nama;
                $kelas             = $pengajuan->kelas;
                $npm        = $pengajuan->npm;
                $no_telp                 = $pengajuan->no_telp;
                $fakultas                 = $pengajuan->fakultas;
                $jurusan                 = $pengajuan->jurusan;
                $semester             = $pengajuan->semester;
                $tahun_angkatan                 = $pengajuan->tahun_angkatan;
                $region             = $pengajuan->region_kampus;

                $tgl = GetFullDateFull(date('Y-m-d'));

                $this->sertifikat($nama_lengkap, $kelas, $npm, $no_telp, $fakultas, $jurusan, $semester, $tahun_angkatan, $region, $tgl);
                $pdf_name = 'Pengajuan_Keikutsertaan_Pembelajaraan_Agama_Khonghucu_Verif_' . @$npm . '_' . time() . '.pdf';
                $data = array(
                    'file_pdf' => $pdf_name,
                    'status_verif'    => '1'
                );

                $KETERANGAN = "Update Pengajuan: "
                    . "; " . $nama_lengkap
                    . "; " . $kelas
                    . "; " . $npm
                    . "; " . $no_telp
                    . "; " . $fakultas
                    . "; " . $jurusan
                    . "; " . $semester
                    . "; " . $tahun_angkatan
                    . "; " . $region;
                $this->user_log($KETERANGAN);
            } else {
                $status = false;
            }
        } else {
            $this->logout();
        }

        $this->db->where('id_mhs', $id_mhs);
        $this->db->update('form_pengajuan', $data);
        echo json_encode(['status' => $status]);
    }

    //Untuk proses upload file
    function proses_upload_file()
    {

        if (!$this->ion_auth->logged_in()) {
            // alihkan mereka ke halaman login
            redirect('auth/login', 'refresh');
        }

        $id_pengirim = $this->session->userdata('id_mhs');

        //jika mereka sudah login dan sebagai anggota
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(1)) {
            $WAKTU = date('Y-m-d H:i:s');

            $nama_file = "file_sertifikat_" . $id_pengirim . '_';
            $config['upload_path']   = './assets/uploads/anggota/';
            $config['allowed_types'] = 'jpg|png|jpeg|bmp|pdf';
            $config['file_name'] = $nama_file;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('userfile')) {
                $nama = $this->upload->data('file_name');
                $EKSTENSI = pathinfo($nama, PATHINFO_EXTENSION);

                // var_dump($nama);
                // die;

                $file_upload = $this->upload->data();

                $JENIS_FILE = $this->input->post('JENIS_FILE');
                $KETERANGAN_FILE = $this->input->post('KETERANGAN_FILE');

                $KETERANGAN = './assets/uploads/anggota/' . $nama;
                $this->db->insert('log_file', array('id_pengirim' => $id_pengirim, 'jenis_file' => 'Sertifikat', 'ekstensi' => $EKSTENSI, 'dok_file' => $nama, 'tanggal_upload' => $WAKTU, 'keterangan_assets' => $KETERANGAN, 'keterangan_file' => $KETERANGAN_FILE, 'pengirim' => 'ANGGOTA'));
            } else {
                // var_dump($this->upload->do_upload('userfile'));
                // die;
                redirect($_SERVER['REQUEST_URI'], 'refresh');
            }
        } else {
            $this->logout();
        }
    }
    //Hapus file by button
    function hapus_file()
    {
        //jika mereka belum login
        if (!$this->ion_auth->logged_in()) {
            // alihkan mereka ke halaman login
            redirect('auth/login', 'refresh');
        }

        //get data dari parameter URL
        $this->data['DOK_FILE'] = $this->uri->segment(4);


        //jika mereka sudah login dan sebagai admin
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(1)) {
            //Query file BY DOK_FILE
            $query_dok_file = $this->m_anggota->file_list_by_dok_file($this->data['DOK_FILE']);

            if ($query_dok_file->num_rows() > 0) {
                $hasil = $query_dok_file->row();
                $DOK_FILE = $hasil->dok_file;
                if (file_exists($file = './assets/uploads/anggota/' . $DOK_FILE)) {
                    unlink($file);
                }

                $this->m_anggota->hapus_data_by_dok_file($DOK_FILE);

                $id_anggota = $this->session->userdata('id_mhs');
                redirect('/pengurus/list_anggota/detail_upload/' . $id_anggota, 'refresh');
            } else {
                $id_anggota = $this->session->userdata('id_mhs');
                redirect('/pengurus/list_anggota/detail_upload/' . $id_anggota, 'refresh');
            }
        } else {
            // set the flash data error message if there is one
            $this->ion_auth->logout();
            $this->session->set_flashdata('message', 'Anda tidak memiliki otorisasi untuk mengakses sistem, silahkan hubungi admin');
        }
    }

    public function sertifikat($nama_lengkap, $kelas, $npm, $no_telp, $fakultas, $jurusan, $semester, $tahun_angkatan, $region, $tgl)
    {
        require FCPATH . 'vendor/tcpdf/tcpdf.php';
        $pdf = new \TCPDF();


        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(false, 0);

        // set image 1
        $pdf->AddPage('P');


        // -- set new background ---

        // get the current page break margin
        $bMargin = $pdf->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $pdf->getAutoPageBreak();
        // disable auto-page-break
        $pdf->SetAutoPageBreak(false, 0);
        // set bacground image
        // restore auto-page-break status
        $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $pdf->setPageMark();

        $html = '<p style="font-size:12;">PENGAJUAN KEIKUTSERTAAN PEMBELAJARAN</p><br>';
        $pdf->writeHTMLCell(0, 0, 10, 25, $html, 0, 0, 0, true, 'C');
        $html = '<p style="font-size:12;">AGAMA KHONGHUCU</p><br>';
        $pdf->writeHTMLCell(0, 0, 10, 32, $html, 0, 0, 0, true, 'C');
        $htmls = '<p style="font-size:12;">KBMK UNIVERSITAS GUNADARMA</p><br>';
        $pdf->writeHTMLCell(0, 0, 10, 39, $htmls, 0, 0, 0, true, 'C');

        $html = '<p style="font-size:12;">Kepada Yth.</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 60, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Ketua Pengurus</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 65, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Keluarga Besar Mahasiswa Khonghucu</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 70, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Universitas Gunadarma</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 75, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Dengan hormat, saya yang bertanda tangan dibawah ini : </p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 85, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Nama</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 95, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Kelas</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 102, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">NPM</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 109, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">No. Telp (WA)</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 116, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Fakultas / Jurusan</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 123, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Semester</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 130, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Tahun Angkatan</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 137, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Region Kampus</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 144, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">Dengan ini mengajukan diri untuk dapat mengikuti pembelajaran Agama Khonghucu pada</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 159, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">semester terkait dengan tujuan agar dapat memenuhi kewajiban nilai pendidikan agama</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 164, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">berdasarkan <b>KRS</b> yang telah diambil. Demikian surat pengajuan ini dibuat, atas perhatian dan</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 169, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">bantuannya saya ucapkan terimakasih.</p><br>';
        $pdf->writeHTMLCell(0, 0, 15, 174, $html, 0, 0, 0, true, 'L');


        $html = '<p style="font-size:12;">&nbsp;&nbsp; : &nbsp;&nbsp; ' . $nama_lengkap . '</p><br>';
        $pdf->writeHTMLCell(0, 0, 55, 95, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">&nbsp;&nbsp; : &nbsp;&nbsp; ' . $kelas . '</p><br>';
        $pdf->writeHTMLCell(0, 0, 55, 102, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">&nbsp;&nbsp; : &nbsp;&nbsp; ' . $npm . '</p><br>';
        $pdf->writeHTMLCell(0, 0, 55, 109, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">&nbsp;&nbsp; : &nbsp;&nbsp; ' . $no_telp . '</p><br>';
        $pdf->writeHTMLCell(0, 0, 55, 116, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">&nbsp;&nbsp; : &nbsp;&nbsp; ' . $fakultas . ' / ' . $jurusan . '</p><br>';
        $pdf->writeHTMLCell(0, 0, 55, 123, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">&nbsp;&nbsp; : &nbsp;&nbsp; ' . $semester . '</p><br>';
        $pdf->writeHTMLCell(0, 0, 55, 130, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">&nbsp;&nbsp; : &nbsp;&nbsp; ' . $tahun_angkatan . '</p><br>';
        $pdf->writeHTMLCell(0, 0, 55, 137, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">&nbsp;&nbsp; : &nbsp;&nbsp; ' . $region . '</p><br>';
        $pdf->writeHTMLCell(0, 0, 55, 144, $html, 0, 0, 0, true, 'L');

        $html = '<p style="font-size:12;">' . 'Depok, ' . $tgl . '</p><br>';
        $pdf->writeHTMLCell(100, 5, 138, 193, $html, 0, 0, 0, true, 'L');

        $html = '<img src="assets/template/img/verif_sertif.jpeg" width="150px" height="150px" alt="" srcset="">';

        $pdf->writeHTMLCell(100, 5, 130, 200, $html, 0, 0, 0, true, 'L');


        $pdf_name = 'Pengajuan_Keikutsertaan_Pembelajaraan_Agama_Khonghucu_Verif_' . $npm . '_' . time();
        // $pdf->Output('Laporan-Tcpdf-CodeIgniter.pdf');
        // $pdf->Output(FCPATH.'assets/file/pdf/'.$pdf_name.'.pdf');
        $pdf->Output(FCPATH . 'assets/PDF/' . $pdf_name . '.pdf', 'F');
        return $pdf_name . '.pdf';
    }
}
