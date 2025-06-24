<?php

class Order_model extends CI_Model
{
    public function get_orders_in_shipping()
    {
        $this->db->where('order_status', 3); // Status 3 is "Dalam pengiriman"
        $this->db->where('tracking_number IS NOT NULL');
        $this->db->where('courier IS NOT NULL');
        return $this->db->get('orders')->result();
    }

    public function get_orders_by_status($status)
    {
        $this->db->where('order_status', $status);
        $this->db->where('tracking_number IS NOT NULL', null, false);
        $this->db->where('courier IS NOT NULL', null, false);
        $query = $this->db->get('orders');
        
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
        log_message('debug', 'Found ' . $query->num_rows() . ' orders');
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                log_message('debug', sprintf(
                    'Order #%s (ID: %d) - Status: %d, Resi: %s, Kurir: %s',
                    $row->order_number,
                    $row->id,
                    $row->order_status,
                    $row->tracking_number,
                    $row->courier
                ));
            }
        }
        
        return $query->result();
    }

    public function update_order_status($order_id, $new_status)
    {
        $this->db->where('id', $order_id);
        return $this->db->update('orders', array(
            'order_status' => $new_status
        ));
    }

    public function get_order_by_number($order_number)
    {
        $this->db->where('order_number', $order_number);
        $query = $this->db->get('orders');
        
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
        log_message('debug', 'Found ' . $query->num_rows() . ' orders');
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            log_message('debug', sprintf(
                'Order #%s (ID: %d) - Status: %d, Resi: %s, Kurir: %s',
                $row->order_number,
                $row->id,
                $row->order_status,
                $row->tracking_number ?? 'NULL',
                $row->courier ?? 'NULL'
            ));
        }
        
        return $query->row();
    }
   
    public function get_order_tracking()
    {
        $this->db->where('tracking_number !=', NULL);
        $query = $this->db->get('tracking_number');
        
        // log_message('debug', 'SQL Query: ' . $this->db->last_query());
        // log_message('debug', 'Found ' . $query->num_rows() . ' orders');
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            // log_message('debug', sprintf(
            //     'Order #%s (ID: %d) - Status: %d, Resi: %s, Kurir: %s',
            //     $row->order_number,
            //     $row->id,
            //     $row->order_status,
            //     $row->tracking_number ?? 'NULL',
            //     $row->courier ?? 'NULL'
            // ));
        }
        
        return $query->row();
    }

    public function get_all_orders()
    {
        $this->db->select('order_number, order_status, tracking_number, courier');
        $query = $this->db->get('orders');
        
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
        log_message('debug', 'Found ' . $query->num_rows() . ' orders');
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                log_message('debug', sprintf(
                    'Order #%s - Status: %d, Resi: %s, Kurir: %s',
                    $row->order_number,
                    $row->order_status,
                    $row->tracking_number ?? 'NULL',
                    $row->courier ?? 'NULL'
                ));
            }
        }
        
        return $query->result();
    }
} 