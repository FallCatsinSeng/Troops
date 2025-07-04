<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('customer');

        $this->load->model(array(
            'payment_model' => 'payment',
            'order_model' => 'order',
            'review_model' => 'review'
        ));
    }

    public function index()
{
    $params['title'] = get_settings('store_tagline');

    // Load model produk (jika belum)
    $this->load->model('Product_model', 'product'); // pastikan nama file-nya: Product_model.php

    // Ambil data produk
    $home['products'] = $this->product->get_all_products(); // pastikan fungsi ini ada di model

    $home['total_order'] = $this->order->count_all_orders();
    $home['total_payment'] = $this->payment->count_all_payments();
    $home['total_process_order'] = $this->order->count_process_order();
    $home['total_review'] = $this->review->count_all_reviews();
    $home['flash'] = $this->session->flashdata('store_flash');

    $this->load->view('header', $params);
    $this->load->view('home', $home);
    $this->load->view('footer');
}
public function carts()
{
    $this->load->library('cart');
    
    $data['carts'] = $this->cart->contents();
    $data['total_cart'] = $this->cart->total();
    $data['total_price'] = $this->cart->total();

    $params = []; // Menambahkan ini untuk menghindari Undefined variable
    $params['title'] = 'Keranjang Saya'; // Menetapkan title jika diperlukan

    $this->load->view('header', $params);
    $this->load->view('customer/carts/carts', $data);
    $this->load->view('footer');
}


}