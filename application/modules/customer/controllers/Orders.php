<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('customer');

        $this->load->model(array(
            'order_model' => 'order'
        ));
    }

    public function index()
    {
        $params['title'] = 'Order Saya';

        $config['base_url'] = site_url('customer/orders/index');
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
 
        $orders['orders'] = $this->order->get_all_orders($config['per_page'], $page);
        $orders['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $params);
        $this->load->view('orders/orders', $orders);
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ( $this->order->is_order_exist($id))
        {
            $data = $this->order->order_data($id);
            $items = $this->order->order_items($id);
            $banks = json_decode(get_settings('payment_banks'));
            $banks = (Array) $banks;
 
            $params['title'] = 'Order #'. $data->order_number;

            $order['data'] = $data;
            $order['items'] = $items;
            $order['delivery_data'] = json_decode($data->delivery_data);
            $order['banks'] = $banks;

            $this->load->view('header', $params);
            $this->load->view('orders/view', $order);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function order_api()
    {
        $action = $this->input->get('action');

        switch ($action)
        {
            case 'cancel_order' :
                $id = $this->input->post('id');
                $data = $this->order->order_data($id);

                if ( ($data->payment_method == 1 && $data->order_status == 1) || ($data->payment_method == 2 && $data->order_status == 1))
                {
                    $this->order->cancel_order($id);
                    $response = array('code' => 200, 'success' => TRUE, 'message' => 'Order dibatalkan');
                }
                else
                {
                    $response = array('code' => 200, 'error' => TRUE, 'message' => 'Order tidak dapat dibatalkan');
                }
            break;
            case 'delete_order' :
                $id = $this->input->post('id');
                $data = $this->order->order_data($id);

                if ( ($data->payment_method == 1 && ($data->order_status == 5 || $data->order_status == 4)) || ($data->payment_method == 2 && ($data->order_status == 4 || $sata->order_status == 3)))
                {
                    $this->order->delete_order($id);
                    $response = array('code' => 200, 'success' => TRUE, 'message' => 'Order dihapus');
                }
                else
                {
                    $response = array('code' => 200, 'error' => TRUE, 'message' => 'Order tidak dapat dihapus');
                }
            break;
        }

        $response = json_encode($response);
        $this->output->set_content_type('application/json')
            ->set_output($response);
    }

    public function track($waybill, $courier)
    {
        $biteship_api_key = $this->config->item('biteship_api_key');
        
        if (empty($biteship_api_key)) {
            show_error("Biteship API key is not configured properly. Please contact administrator.");
            return;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.biteship.com/v1/trackings/" . $waybill . "/couriers/" . $courier,
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
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($err) {
            show_error("Error tracking shipment: " . $err);
            return;
        }

        $tracking_data = json_decode($response);
        
        // Debug information
        if ($httpcode != 200) {
            log_message('error', 'Biteship API Error: ' . $response);
            log_message('error', 'HTTP Code: ' . $httpcode);
            log_message('error', 'API Key Used: ' . substr($biteship_api_key, 0, 10) . '...');
        }
            
        $this->load->view('header');
        $this->load->view('orders/tracking', array(
            'tracking_data' => $tracking_data,
            'waybill' => $waybill,
            'courier' => strtoupper($courier)
        ));
        $this->load->view('footer');
    }
}