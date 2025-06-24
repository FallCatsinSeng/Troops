<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'order_model' => 'order'
        ));
    }

    public function index()
    {
        $search = $this->input->get('search_query');

        if ($search) {
            $params['title'] = 'Cari "' . $search . '"';
        } else {
            $params['title'] = 'Kelola Order';
        }

        $config['base_url'] = site_url('admin/orders/index');
        $config['total_rows'] = $this->order->count_all_orders();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);

        $config['first_link']       = '«';
        $config['last_link']        = '»';
        $config['next_link']        = '›';
        $config['prev_link']        = '‹';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $orders['orders'] = $this->order->get_all_orders($config['per_page'], $page, $search);
        $orders['pagination'] = $this->pagination->create_links();
        $orders['search_query'] = $search;

        $this->load->view('header', $params);
        $this->load->view('orders/orders', $orders);
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ($this->order->is_order_exist($id)) {
            $data = $this->order->order_data($id);
            $items = $this->order->order_items($id);
            $banks = json_decode(get_settings('payment_banks'));
            $banks = (array) $banks;

            $params['title'] = 'Order #' . $data->order_number;

            $order['data'] = $data;
            $order['items'] = $items;
            $order['delivery_data'] = json_decode($data->delivery_data);
            $order['banks'] = $banks;
            $order['order_flash'] = $this->session->flashdata('order_flash');
            $order['payment_flash'] = $this->session->flashdata('payment_flash');

            $this->load->view('header', $params);
            $this->load->view('orders/view', $order);
            $this->load->view('footer');
        } else {
            show_404();
        }
    }

    public function status()
    {
        $order = $this->input->post('order');
        $status = $this->input->post('status');
        $courier = $this->input->post('courier');
        $tracking_number = $this->input->post('tracking_number');

        // Jika tracking number diisi dan status belum "Dalam pengiriman"
        // if (!empty($tracking_number) && $status < 3) {
        // if (!empty($tracking_number) && $status < 3) {
        //     $status = 3; // Set status jadi "Dalam pengiriman"
        // }
        
        $data = array(
            'order_status' => $status,
            'courier' => $courier,
            'tracking_number' => $tracking_number
        );

        $this->order->update($order, $data);
        $this->session->set_flashdata('order_flash', 'Status order berhasil diperbarui');
      
        
        redirect('admin/orders/view/'. $order);
    }

    public function pdf($id)
    {
        if ($this->order->is_order_exist($id)) {
            $this->load->library('pdf');
            $data = $this->order->order_data($id);

            $items = $this->order->order_items($id);
            $banks = json_decode(get_settings('payment_banks'));
            $banks = (array) $banks;

            $params['data'] = $data;
            $params['items'] = $items;
            $params['delivery_data'] = json_decode($data->delivery_data);
            $params['banks'] = $banks;

            $html = $this->load->view('orders/pdf', $params, true);
            $this->pdf->createPDF($html, 'order_' . $data->order_number, false, 'A3');
        } else {
            show_404();
        }
    }


    public function update_shipping_status()
    {
        // Pastikan fungsi ini hanya bisa dijalankan dari command line untuk keamanan
        if (!$this->input->is_cli_request()) {
            log_message('error', 'Akses tidak sah ke fungsi update_shipping_status.');
            show_404();
            return;
        }

        log_message('info', 'Cron Job: Memulai pengecekan status pengiriman...');

        // 1. Cek data order dimana tracking_number tidak kosong dan statusnya "Dalam Pengiriman" (status = 3)
        $shipping_orders = $this->order->get_shipped_orders_with_tracking();

        if (empty($shipping_orders)) {
            log_message('info', 'Cron Job: Tidak ada order yang perlu dicek statusnya.');
            echo "Tidak ada order yang perlu dicek.\n";
            return;
        }

        log_message('info', 'Cron Job: Ditemukan ' . count($shipping_orders) . ' order untuk dicek.');
        echo 'Ditemukan ' . count($shipping_orders) . " order untuk dicek.\n";

        // 2. Lakukan foreach untuk setiap order
        foreach ($shipping_orders as $order) {
            log_message('info', sprintf('Mengecek Order #%s (Resi: %s, Kurir: %s)', $order->order_number, $order->tracking_number, $order->courier));
            echo sprintf("Mengecek Order #%s...\n", $order->order_number);

            // Panggil API Biteship
            $response = $this->_call_biteship_api($order->tracking_number, $order->courier);
            echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";

            if (!$response || !$response->success || empty($response->history)) {
                log_message('error', 'Gagal mendapatkan data valid dari Biteship untuk resi: ' . $order->tracking_number . '. Response: ' . json_encode($response));
                continue; // Lanjut ke order berikutnya
            }

            // Ambil status terakhir dari riwayat
            $latest_history = end($response->history);
            $latest_status = strtolower($latest_history->status);

            log_message('info', 'Status terakhir dari Biteship untuk resi ' . $order->tracking_number . ': ' . $latest_status);

            // 3. Cek jika status 'delivered' dan update jika perlu
            if ($latest_status === 'delivered' && $order->order_status != 4) {
                $update_data = ['order_status' => 4];
                $this->order->update($order->id, $update_data);
                
                log_message('info', 'SUKSES: Order #' . $order->order_number . ' telah diupdate menjadi "Terkirim" (status 4).');
                echo "SUKSES: Order #" . $order->order_number . " diupdate ke status Terkirim.\n";
            } else if($latest_status !== 'delivered') {
                $update_data = ['order_status' => 3];
                $this->order->update($order->id, $update_data);
                
                log_message('info', 'SUKSES: Order #' . $order->order_number . ' telah diupdate menjadi "Terkirim" (status 4).');
                echo "SUKSES: Order #" . $order->order_number . " diupdate ke status Terkirim.\n";
            }
        }

        log_message('info', 'Cron Job: Pengecekan status pengiriman selesai.');
        echo "Proses selesai.\n";
    }

    /**
     * Helper privat untuk memanggil API Biteship menggunakan cURL.
     */
    // private function _call_biteship_api($tracking_number, $courier)
    // {
    //     // GANTI DENGAN API KEY BITESHIp Anda
    //     // Sebaiknya simpan di config atau database
    //     $api_key = 'YOUR_BITESHIP_API_KEY';

    //     $curl = curl_init();
    //     $endpoint = "https://api.biteship.com/v1/trackings/$tracking_number/couriers/$courier";

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => $endpoint,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => [
    //             "Authorization: $api_key"
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);

    //     if ($err) {
    //         log_message('error', "cURL Error #:" . $err);
    //         return null;
    //     }

    //     return json_decode($response);
    // }

    public function _call_biteship_api($tracking_number, $courier)
    {
        // Mock response untuk testing
        return (object)[
            'success' => true,
            'history' => [
                (object)[
                    'status' => 'delivered',
                    'description' => 'Paket telah diterima',
                    'timestamp' => date('Y-m-d H:i:s')
                ]
            ]
        ];

        // Uncomment kode di bawah ini setelah API key Biteship sudah benar
        /*
        $biteship_api_key = $this->config->item('biteship_api_key');
        
        if (empty($biteship_api_key)) {
            log_message('error', 'Biteship API key not configured');
            return null;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.biteship.com/v1/trackings/$tracking_number/couriers/$courier",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $biteship_api_key,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            log_message('error', "cURL Error: " . $err);
            return null;
        }

        $result = json_decode($response);
        
        if (!$result || !isset($result->success)) {
            log_message('error', "Invalid response from Biteship: " . $response);
            return null;
        }

        return $result;
        */
    }

    public function check_shipping_status()
    {
        // Hanya terima request AJAX
        if (!$this->input->is_ajax_request()) {
            redirect('admin/orders');
            return;
        }

        // 1. Cek data order dimana tracking_number tidak kosong dan statusnya "Dalam Pengiriman" (status = 3)
        $shipping_orders = $this->order->get_shipped_orders_with_tracking();
        $updated = 0;

        if (!empty($shipping_orders)) {
            // 2. Lakukan foreach untuk setiap order
            foreach ($shipping_orders as $order) {
                // Panggil API Biteship
                $response = $this->_call_biteship_api($order->tracking_number, $order->courier);

                if (!$response || empty($response->history)) {
                    continue; // Lanjut ke order berikutnya
                }

                // Ambil status terakhir dari riwayat
                $latest_history = end($response->history);
                $latest_status = strtolower($latest_history->status);

                // Update status berdasarkan response
                if ($latest_status === 'delivered' && $order->order_status != 4) {
                    $this->order->update($order->id, ['order_status' => 4]);
                    $updated++;
                } else if ($latest_status !== 'delivered' && $order->order_status != 3) {
                    $this->order->update($order->id, ['order_status' => 3]);
                    $updated++;
                }
            }
        }

        // Return response dalam format JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'updated' => $updated
            ]));
    }
}