<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_status_update extends CI_Controller {
    // Menggunakan token yang sama dari checkout.js
    private $biteship_token = 'biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiVGVzdGluZyIsInVzZXJJZCI6IjY4M2M2ZmUxN2YwNGNlMDAxMjk0YjZiMiIsImlhdCI6MTc0ODgyOTg0MX0.857GlvJl5atH049dsjs5kBouNTkh4UEnOJZjWNUgtmQ';

    public function __construct() {
        parent::__construct();
        
        // Pastikan hanya bisa diakses via CLI (cron)
        if (!$this->input->is_cli_request()) {
            exit('This script can only be accessed via CLI');
        }

        $this->load->model('order_model');
    }

    // Method yang akan dijalankan setiap jam 5 sore via cron
    public function update() {
        log_message('info', 'Starting order status update cron job at ' . date('Y-m-d H:i:s'));

        // Ambil semua order yang statusnya sedang dalam pengiriman
        $shipping_orders = $this->order_model->get_orders_by_status(3); // status 3 = dalam pengiriman
        
        if (empty($shipping_orders)) {
            log_message('info', 'No orders in shipping status found');
            return;
        }

        foreach ($shipping_orders as $order) {
            if (empty($order->tracking_number) || empty($order->courier)) {
                log_message('info', sprintf('Order #%s missing tracking info (Resi: %s, Kurir: %s)', 
                    $order->order_number, 
                    $order->tracking_number ?? 'NULL',
                    $order->courier ?? 'NULL'
                ));
                continue;
            }

            log_message('info', sprintf('Checking order #%s (Resi: %s, Kurir: %s)', 
                $order->order_number, 
                $order->tracking_number,
                $order->courier
            ));

            $tracking_info = $this->_get_tracking_status($order->tracking_number, $order->courier);
            
            if (!$tracking_info) {
                log_message('error', 'Failed to get tracking info - API call failed');
                continue;
            }

            log_message('debug', 'Raw Biteship Response: ' . json_encode($tracking_info));

            if (!isset($tracking_info->success) || !$tracking_info->success) {
                log_message('error', 'Biteship API returned error: ' . json_encode($tracking_info));
                continue;
            }

            if (!isset($tracking_info->history) || empty($tracking_info->history)) {
                log_message('error', 'No tracking history found in response');
                continue;
            }

            // Get latest status from history
            $latest_status = end($tracking_info->history);
            if (!$latest_status || !isset($latest_status->status)) {
                log_message('error', 'Invalid status in tracking history');
                continue;
            }

            $new_status = $this->_convert_biteship_status($latest_status->status);
            if (!$new_status) {
                log_message('info', sprintf('No status mapping for Biteship status: %s', $latest_status->status));
                continue;
            }

            if ($new_status != $order->order_status) {
                $this->order_model->update_order_status($order->id, $new_status);
                log_message('info', sprintf(
                    'Updated order #%s status from %s to %s (Biteship status: %s)',
                    $order->order_number,
                    $order->order_status,
                    $new_status,
                    $latest_status->status
                ));
            } else {
                log_message('info', sprintf(
                    'Order #%s status unchanged (Current: %s, Biteship: %s)',
                    $order->order_number,
                    $order->order_status,
                    $latest_status->status
                ));
            }
        }

        log_message('info', 'Completed order status update cron job at ' . date('Y-m-d H:i:s'));
    }

    private function _get_tracking_status($tracking_number, $courier) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.biteship.com/v1/trackings/' . $tracking_number . '/couriers/' . strtolower($courier),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->biteship_token
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($err) {
            log_message('error', sprintf(
                'Curl Error for %s - %s: %s',
                $courier,
                $tracking_number,
                $err
            ));
            return false;
        }

        if ($httpcode != 200) {
            log_message('error', sprintf(
                'HTTP Error %d for %s - %s: %s',
                $httpcode,
                $courier,
                $tracking_number,
                $response
            ));
            return false;
        }

        return json_decode($response);
    }

    private function _convert_biteship_status($biteship_status) {
        // Konversi status Biteship ke status order sistem
        $status = strtoupper($biteship_status);
        log_message('info', 'Biteship status received: ' . $status);
        $delivered_statuses = [
            'DELIVERED',
            'TERKIRIM',
            'DELIVERED_TO_RECIPIENT',
            'RECEIVED',
            'DELIVERED TO RECIPIENT',
            'DELIVERED_TO_BUYER',
            'DELIVERED TO BUYER',
            'COMPLETED',
            'SELESAI',
        ];
        if (in_array($status, $delivered_statuses)) {
            return 4; // Selesai
        }
        switch ($status) {
            case 'RETURNED':
            case 'FAILED DELIVERY':
            case 'FAILED':
            case 'RETURN TO SENDER':
                return 5; // Batalkan
            case 'PICKED_UP':
            case 'PICKED UP':
            case 'IN_TRANSIT':
            case 'IN TRANSIT':
            case 'WITH_COURIER':
            case 'WITH COURIER':
            case 'IN_PICKUP':
            case 'IN PICKUP':
                return 3; // Dalam pengiriman
            default:
                log_message('debug', 'Unknown Biteship status: ' . $biteship_status);
                return false;
        }
    }

    public function check_order($order_number)
    {
        log_message('info', 'Checking specific order: ' . $order_number);
        
        $order = $this->order_model->get_order_by_number($order_number);
        if (!$order) {
            log_message('error', 'Order not found: ' . $order_number);
            return;
        }

        if (empty($order->tracking_number) || empty($order->courier)) {
            log_message('info', sprintf('Order #%s missing tracking info (Resi: %s, Kurir: %s)', 
                $order->order_number, 
                $order->tracking_number ?? 'NULL',
                $order->courier ?? 'NULL'
            ));
            return;
        }

        log_message('info', sprintf('Checking order #%s (Resi: %s, Kurir: %s)', 
            $order->order_number, 
            $order->tracking_number,
            $order->courier
        ));

        $tracking_info = $this->_get_tracking_status($order->tracking_number, $order->courier);
        
        if (!$tracking_info) {
            log_message('error', 'Failed to get tracking info - API call failed');
            return;
        }

        log_message('debug', 'Raw Biteship Response: ' . json_encode($tracking_info));

        if (!isset($tracking_info->success) || !$tracking_info->success) {
            log_message('error', 'Biteship API returned error: ' . json_encode($tracking_info));
            return;
        }

        if (!isset($tracking_info->history) || empty($tracking_info->history)) {
            log_message('error', 'No tracking history found in response');
            return;
        }

        // Get latest status from history
        $latest_status = end($tracking_info->history);
        if (!$latest_status || !isset($latest_status->status)) {
            log_message('error', 'Invalid status in tracking history');
            return;
        }

        $new_status = $this->_convert_biteship_status($latest_status->status);
        if (!$new_status) {
            log_message('info', sprintf('No status mapping for Biteship status: %s', $latest_status->status));
            return;
        }

        if ($new_status != $order->order_status) {
            $this->order_model->update_order_status($order->id, $new_status);
            log_message('info', sprintf(
                'Updated order #%s status from %s to %s (Biteship status: %s)',
                $order->order_number,
                $order->order_status,
                $new_status,
                $latest_status->status
            ));
        } else {
            log_message('info', sprintf(
                'Order #%s status unchanged (Current: %s, Biteship: %s)',
                $order->order_number,
                $order->order_status,
                $latest_status->status
            ));
        }
    }

    public function list_orders()
    {
        log_message('info', 'Listing all orders');
        $this->order_model->get_all_orders();
    }

    public function run_from_admin() {
        // Optional: Batasi hanya untuk admin yang login
        if (!is_admin()) {
            show_404();
            return;
        }
        $this->update();
        echo json_encode(['success' => true]);
    }
} 