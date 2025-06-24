<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model([
            'product_model' => 'product',
            'review_model' => 'review',
            'videos_model' => 'videos'
        ]);
    }

    public function index() {
        $params['title'] = 'Selamat Datang di Converse';

        $data['products'] = $this->product->get_all_products();
        $data['best_deal'] = $this->product->best_deal_product();
        $data['reviews'] = $this->review->get_all_reviews();
        $data['videos'] = $this->videos->get_all_videos(); // ✅ Ambil data video

        get_header($params);
        get_template_part('home', $data);
        get_footer();
    }
}
