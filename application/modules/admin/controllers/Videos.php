<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        // Verifikasi session admin
        verify_session('admin');

        // Load model video
        $this->load->model('Videos_model', 'video');
        
        // Load form validation library
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Menampilkan daftar video dengan pagination
        $params['title'] = 'Kelola Video ' . get_store_name();

        $config['base_url'] = site_url('admin/videos');
        $config['total_rows'] = $this->video->count_all_videos();
        $config['per_page'] = 16;
        $config['uri_segment'] = 4;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);

        // Styling pagination
        $config['first_link'] = '«';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['prev_link'] = '‹';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->load->library('pagination', $config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $videos['videos'] = $this->video->get_all_videos($config['per_page'], $page);
        $videos['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $params);
        $this->load->view('videos/index', $videos);
        $this->load->view('footer');
    }

    // di controller Videos.php
     // Fungsi untuk menangani API request
     public function video_api()
     {
         $action = $this->input->get('action');

         switch($action) {
             case 'video_list':
                 $this->_ajax_video_list();
                 break;
             case 'add_video':
                 $this->_ajax_add_video();
                 break;
             case 'delete_video':
                 $this->_ajax_delete_video();
                 break;
             default:
                 $this->output
                     ->set_status_header(400)
                     ->set_content_type('application/json')
                     ->set_output(json_encode(['message' => 'Invalid action']));
         }
     }
 
     // Fungsi untuk menampilkan daftar video (AJAX)
     private function _ajax_video_list()
     {
         // Ambil semua data video dari model
         $videos = $this->video->get_all_videos();
         
         // Format data untuk DataTables
         $data = [];
         foreach ($videos as $video) {
             $data[] = [
                 'id' => $video->id,
                 'title' => $video->title,
                 'url' => $video->url,
                 'created_at' => date('d/m/Y H:i', strtotime($video->created_at))
             ];
         }
         
         // Kirim response sesuai format DataTables
         $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode([
                 'draw' => $this->input->get('draw'),
                 'recordsTotal' => count($data),
                 'recordsFiltered' => count($data),
                 'data' => $data
             ]));
     }
 
     // Fungsi untuk menambah video (AJAX)
     private function _ajax_add_video()
     {
         $data = array(
             'title' => $this->input->post('title'),
             'url' => $this->input->post('url'),
             'created_at' => date('Y-m-d H:i:s')
         );

         $insert = $this->video->insert_video($data);

         if ($insert) {
             $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(array(
                     'status' => 'success',
                     'message' => 'Video berhasil ditambahkan'
                 )));
         } else {
             $this->output
                 ->set_status_header(500)
                 ->set_content_type('application/json')
                 ->set_output(json_encode(array(
                     'status' => 'error',
                     'message' => 'Gagal menambahkan video'
                 )));
         }
     }
 
     // Fungsi untuk menampilkan halaman tambah video
     public function add_video()
     {
         $data = array(
             'title' => $this->input->post('title'),
             'url' => $this->input->post('url'),
             'created_at' => date('Y-m-d H:i:s')
         );

         $insert = $this->video->insert_video($data);

         if ($insert) {
             $this->session->set_flashdata('success', 'Video berhasil ditambahkan');
         } else {
             $this->session->set_flashdata('error', 'Gagal menambahkan video');
         }

         redirect('admin/videos');
     }
 
     // Fungsi untuk menghapus video (optional, jika diperlukan)
     public function delete_video($id)
     {
         $delete = $this->video->delete_video($id);

         if ($delete) {
             $this->session->set_flashdata('success', 'Video berhasil dihapus');
         } else {
             $this->session->set_flashdata('error', 'Gagal menghapus video');
         }

         redirect('admin/videos');
     }

     private function _ajax_delete_video()
     {
         $id = $this->input->post('id');
         $delete = $this->video->delete_video($id);

         if ($delete) {
             $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(array(
                     'status' => 'success',
                     'message' => 'Video berhasil dihapus'
                 )));
         } else {
             $this->output
                 ->set_status_header(500)
                 ->set_content_type('application/json')
                 ->set_output(json_encode(array(
                     'status' => 'error',
                     'message' => 'Gagal menghapus video'
                 )));
         }
     }
    }