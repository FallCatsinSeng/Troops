<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->library('cart');
        $this->load->library('biteship');
        $this->load->library('encryption');
        $this->load->model(array(
            'product_model' => 'product',
            'customer_model' => 'customer'
        ));
    }

    public function product($id = 0, $sku = '')
    {
        if ($id == 0 || empty($sku))
        {
            show_error('Akses tidak sah!');
        }
        else
        {
            if ($this->product->is_product_exist($id, $sku))
            {
                $data = $this->product->product_data($id);

                $product['product'] = $data;
                $product['related_products'] = $this->product->related_products($data->id, $data->category_id);

                get_header($data->name .' | '. get_settings('store_tagline'));
                get_template_part('shop/view_single_product', $product);
                get_footer();
            }
            else
            {
                show_404();
            }
        }
    }

    public function cart()
    {
        // Debug user session
        $encrypted_session = $this->session->userdata('__ACTIVE_SESSION_DATA');
        if ($encrypted_session) {
            $decrypted_data = $this->encryption->decrypt($encrypted_session);
            $session_data = json_decode($decrypted_data, true);
            if (!$session_data || !isset($session_data['user_id'])) {
                redirect('auth/login?redirect=' . urlencode(current_url()));
            }
        } else {
            redirect('auth/login?redirect=' . urlencode(current_url()));
        }

        $data = array();
        $data['carts'] = $this->cart->contents();
        $data['total_cart'] = $this->cart->total();
        $data['total_price'] = $this->cart->total();
        
        get_header('Keranjang Belanja');
        get_template_part('shop/cart', $data);
        get_footer();
    }
    
    public function checkout($action = '')
    {
        if ( ! is_login()) {
            $coupon = $this->input->post('coupon_code');
            $quantity = $this->input->post('quantity');

            $this->session->set_userdata('_temp_coupon', $coupon);
            $this->session->set_userdata('_temp_quantity', $quantity);

            verify_session('customer');
        }
        switch ($action)
        {
            default :
                $coupon = $this->input->post('coupon_code') ? $this->input->post('coupon_code') : $this->session->userdata('_temp_coupon');
                $quantity = $this->input->post('quantity') ? $this->input->post('quantity') : $this->session->userdata('_temp_quantity');

                if ($this->session->userdata('_temp_quantity') || $this->session->userdata('_temp_coupon'))
                {
                    $this->session->unset_userdata('_temp_coupon');
                    $this->session->unset_userdata('_temp_quantity');
                }

                $items = [];
                foreach ($quantity as $rowid => $qty) {
                    $items[] = [
                        'rowid' => $rowid,
                        'qty'   => $qty
                    ];
                }
                $this->cart->update($items);

                if ( empty($coupon)) 
                {
                    $discount = 0;
                    $disc = 'Tidak menggunkan kupon';
                }
                else
                {
                    if ($this->customer->is_coupon_exist($coupon))
                    {
                        if ($this->customer->is_coupon_active($coupon))
                        {
                            if ( $this->customer->is_coupon_expired($coupon))
                            {
                                $discount = 0;
                                $disc = 'Kupon kadaluarsa';
                            }
                            else
                            {
                                $coupon_id = $this->customer->get_coupon_id($coupon);
                                $this->session->set_userdata('coupon_id', $coupon_id);

                                $credit = $this->customer->get_coupon_credit($coupon);
                                $discount = $credit;
                                $disc = '<span class="badge badge-success">'. $coupon .'</span> Rp '. format_rupiah($credit);
                            }
                        }
                        else
                        {
                            $discount = 0;
                            $disc = 'Kupon sudah tidak aktif';
                        }
                    }
                    else
                    {
                        $discount = 0;
                        $disc = 'Kupon tidak terdaftar';
                    }
                }

                $items = [];

                foreach ($this->cart->contents() as $item)
                {
                    $items[$item['id']]['qty'] = $item['qty'];
                    $items[$item['id']]['price'] = $item['price'];
                }
                 
                $subtotal = $this->cart->total();
                $shipping_cost = (int) $this->input->post('shipping_cost');
                $total_price = $subtotal + $shipping_cost;
                $total_items = count($quantity);
                $payment = $this->input->post('payment');

                $params['customer'] = $this->customer->data();
                $params['subtotal'] = $subtotal;
                $params['shipping_cost'] = $shipping_cost;
                $params['total'] = $total_price;
                $params['discount'] = $disc;

                $this->session->set_userdata('order_quantity', $items);
                $this->session->set_userdata('total_price', $total_price);

                get_header('Checkout');
                get_template_part('shop/checkout', $params);
                get_footer();
            break;
            case 'order' :
                $quantity = $this->session->userdata('order_quantity');

                $user_id = get_current_user_id();
                $coupon_id = $this->session->userdata('coupon_id');
                $order_number = $this->_create_order_number($quantity, $user_id, $coupon_id);
                $order_date = date('Y-m-d H:i:s');
                $total_price = $this->session->userdata('total_price');
                $total_items = count($quantity);
                $payment = $this->input->post('payment');

                $name = $this->input->post('name');
                $phone_number = $this->input->post('phone_number');
                $provinsi = $this->input->post('provinsi');
                $kabupaten = $this->input->post('kabupaten');
                $kecamatan = $this->input->post('kecamatan');
                $desa = $this->input->post('desa');
                $address = $this->input->post('address');
                $kode_pos = $this->input->post('kode_pos');
                $courier = $this->input->post('courier');
                $service = $this->input->post('service');
                $note = $this->input->post('note');

                $delivery_data = array(
                    'customer' => array(
                        'name' => $name,
                        'phone_number' => $phone_number,
                        'provinsi' => $provinsi,
                        'kabupaten' => $kabupaten,
                        'kecamatan' => $kecamatan,
                        'desa' => $desa,
                        'address' => $address,
                        'kode_pos' => $kode_pos
                    ),
                    'shipping' => array(
                        'courier' => $courier,
                        'service' => $service
                    ),
                    'note' => $note
                );

                $delivery_data = json_encode($delivery_data);

                $shipping_cost = (int) $this->input->post('shipping_cost');
                $total_price = $total_price + $shipping_cost;

                $order = array(
                    'user_id' => $user_id,
                    'coupon_id' => $coupon_id,
                    'order_number' => $order_number,
                    'order_status' => 1,
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_items' => $total_items,
                    'payment_method' => $payment,
                    'delivery_data' => $delivery_data,
                    'shipping_cost' => $shipping_cost,
                    'courier' => $courier
                );

                $order = $this->product->create_order($order);

                $n = 0;
                foreach ($quantity as $id => $data)
                {
                    $items[$n]['order_id'] = $order;
                    $items[$n]['product_id'] = $id;
                    $items[$n]['order_qty'] = $data['qty'];
                    $items[$n]['order_price'] = $data['price'];

                    $n++;
                }

                $this->product->create_order_items($items);

                $this->cart->destroy();
                $this->session->unset_userdata('order_quantity');
                $this->session->unset_userdata('total_price');
                $this->session->unset_userdata('coupon_id');

                $this->session->set_flashdata('order_flash', 'Order berhasil ditambahkan');

                redirect('customer/orders/view/'. $order);
            break;
        }

    }

    public function all_products()
{
    // Memuat model produk
    $this->load->model('Product_model'); // pastikan modelnya benar
    $data['products'] = $this->Product_model->get_all_products(); // Memanggil method untuk mengambil semua produk dari model

    // Menampilkan view dengan data produk
    get_header('Produk');
    get_template_part('shop/all_products', $data);
    get_footer();
}

    public function cart_api()
    {
        $action = $this->input->get('action');
        
        if ($action == 'remove_item')
        {
            $rowid = $this->input->post('rowid');
            
            $this->cart->remove($rowid);
            $total = $this->cart->total();
            $count = count($this->cart->contents());
            
            $response = array(
                'code' => 204,
                'message' => 'Item dihapus dari keranjang',
                'total' => array(
                    'subtotal' => 'Rp '. number_format($total, 2, ',', '.'),
                    'subtotal_raw' => (float)$total,
                    'total' => 'Rp '. number_format($total, 2, ',', '.'),
                    'total_raw' => (float)$total,
                    'ongkir' => 'Rp 0,00'
                )
            );
            
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }
        else if ($action == 'update_item')
        {
            $rowid = $this->input->post('rowid');
            $qty = intval($this->input->post('qty'));
            
            if ($qty > 0 && $qty <= 100) {
                $this->cart->update(array(
                    'rowid' => $rowid,
                    'qty' => $qty
                ));
                
                $total = (float)$this->cart->total();
                
                $response = array(
                    'code' => 200,
                    'message' => 'Quantity updated',
                    'total' => array(
                        'subtotal' => 'Rp '. number_format($total, 2, ',', '.'),
                        'subtotal_raw' => $total,
                        'total' => 'Rp '. number_format($total, 2, ',', '.'),
                        'total_raw' => $total,
                        'ongkir' => 'Rp 0,00'
                    )
                );
                
                $this->output->set_content_type('application/json')->set_output(json_encode($response));
                return;
            }
        }
        else if ($action == 'get_products_detail')
        {
            // Get product IDs from POST
            $product_ids = $this->input->post('product_ids');
            
            // Convert single ID to array
            if (!is_array($product_ids)) {
                $product_ids = [$product_ids];
            }

            // Get product details from database
            $this->db->select('id, name, description, length, width, height, weight');
            $this->db->from('products');
            $this->db->where_in('id', $product_ids);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                $products = $query->result();
                
                // Convert to array and ensure integer values
                $products_array = array_map(function($product) {
                    return array(
                        'id' => intval($product->id),
                        'name' => $product->name,
                        'description' => $product->description,
                        'length' => intval($product->length ?? 20),
                        'width' => intval($product->width ?? 20),
                        'height' => intval($product->height ?? 10),
                        'weight' => intval($product->weight ?? 800)
                    );
                }, $products);

                $response = array(
                    'code' => 200,
                    'message' => 'Success',
                    'data' => $products_array
                );
            } else {
                $response = array(
                    'code' => 404,
                    'message' => 'No products found',
                    'data' => array()
                );
            }
            
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }

        // For adding items, implement protection against double submission
        $sku = $this->input->post('sku');
        $qty = intval($this->input->post('qty'));
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        
        // Generate a unique request ID
        $request_id = $id . '_' . time();
        
        // Check if this is a duplicate request within 2 seconds
        $last_request = $this->session->userdata('last_cart_request');
        $last_time = $this->session->userdata('last_cart_time');
        
        if ($last_request == $request_id && (time() - $last_time) < 2) {
            $response = array('code' => 429, 'message' => 'Please wait before adding more items');
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }
        
        // Store current request info
        $this->session->set_userdata('last_cart_request', $request_id);
        $this->session->set_userdata('last_cart_time', time());
        
        // Check if item already exists in cart
        $cart_contents = $this->cart->contents();
        $item_exists = false;
        $rowid = '';
        $current_qty = 0;
        
        foreach ($cart_contents as $key => $item) {
            if ($item['id'] == $id) {
                $item_exists = true;
                $rowid = $key;
                $current_qty = $item['qty'];
                break;
            }
        }
        
        if ($item_exists) {
            // Add new quantity to existing quantity
            $this->cart->update(array(
                'rowid' => $rowid,
                'qty' => $current_qty + $qty
            ));
        } else {
            // Insert new item
            $item = array(
                'id' => $id,
                'qty' => $qty,
                'price' => $price,
                'name' => $name
            );
            $this->cart->insert($item);
        }
        
        $total_item = count($this->cart->contents());
        $total = $this->cart->total();

        $response = array(
            'code' => 200, 
            'message' => 'Item dimasukkan dalam keranjang', 
            'total_items' => $total_item,
            'total' => format_rupiah($total)
        );

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function get_cart_items()
    {
        $cart_items = $this->cart->contents();
        $items = array();

        foreach ($cart_items as $item) {
            // Get complete product details from database
            $product = $this->product->product_data($item['id']);
            
            // If product exists in database
            if ($product) {
                $items[] = array(
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'description' => $product->description,
                    // 'description' => "Cek",
                    'price' => (int)$item['price'],
                    'value' => (int)$item['price'],
                    // Use product dimensions if available, otherwise use defaults
                    'length' => !empty($product->length) ? (int)$product->length : 20,
                    'width' => !empty($product->width) ? (int)$product->width : 20,
                    'height' => !empty($product->height) ? (int)$product->height : 10,
                    'weight' => !empty($product->weight) ? (int)$product->weight : 400,
                    'quantity' => (int)$item['qty'],
                    'qty' => (int)$item['qty'],
                    // Add additional product info that might be useful
                    'sku' => $product->sku,
                    'category' => $product->category_name
                );
            } else {
                // If product not found in database, use cart data with defaults
                $items[] = array(
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'description' => $item['name'],
                    'price' => (int)$item['price'],
                    'value' => (int)$item['price'],
                    // Use default dimensions
                    'length' => 20,
                    'width' => 20,
                    'height' => 10,
                    'weight' => 400,
                    'quantity' => (int)$item['qty'],
                    'qty' => (int)$item['qty']
                );
            }
        }

        // If cart is empty, return empty array with proper structure
        if (empty($items)) {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'error' => 'Cart is empty',
                    'items' => array()
                )));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'success' => true,
                'items' => $items,
                'total_items' => count($items)
            )));
    }

    public function _create_order_number($quantity, $user_id, $coupon_id)
    {
        $this->load->helper('string');

        $alpha = strtoupper(random_string('alpha', 3));
        $num = random_string('numeric', 3);
        $count_qty = count($quantity);


        $number = $alpha . date('j') . date('n') . date('y') . $count_qty . $user_id . $coupon_id . $num;
        //Random 3 letter . Date . Month . Year . Quantity . User ID . Coupon Used . Numeric

        return $number;
    }

    // Endpoint untuk mendapatkan daftar kurir
    public function get_couriers()
    {
        $response = $this->biteship->get_couriers();
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Endpoint untuk mencari lokasi
    public function get_locations()
    {
        $query = $this->input->get('query');
        
        if (empty($query)) {
            echo json_encode(['success' => false, 'message' => 'Query is required']);
            return;
        }

        $response = $this->biteship->get_locations($query);
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Endpoint untuk mendapatkan ongkos kirim
    public function get_shipping_rates()
    {
        $destination = $this->input->post('destination_postal_code');
        $courier = $this->input->post('courier');
        $items = json_decode($this->input->post('items'), true);

        if (empty($destination) || empty($courier) || empty($items)) {
            echo json_encode(['success' => false, 'message' => 'Incomplete parameters']);
            return;
        }

        $params = array(
            'origin_postal_code' => $this->config->item('biteship_origin_postal_code'),
            'destination_postal_code' => $destination,
            'couriers' => $courier,
            'items' => $items
        );

        $response = $this->biteship->get_rates($params);
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function create_order()
    {
        if (!is_login()) {
            redirect('auth/login?redirect=' . urlencode(current_url()));
        }

        $user_id = get_current_user_id();
        $coupon_id = $this->session->userdata('coupon_id');
        
        // Get cart items
        $items = [];
        foreach ($this->cart->contents() as $item) {
            $items[$item['id']]['qty'] = $item['qty'];
            $items[$item['id']]['price'] = $item['price'];
        }

        // Calculate totals
        $subtotal = $this->cart->total();
        $shipping_cost = (int) $this->input->post('shipping_cost');
        $total_price = $subtotal + $shipping_cost;
        $total_items = count($items);
        $payment = $this->input->post('payment');
        $note = $this->input->post('note');

        // Create order number
        $order_number = $this->_create_order_number($items, $user_id, $coupon_id);
        $order_date = date('Y-m-d H:i:s');

        // Get customer data
        $customer = $this->customer->data();

        $delivery_data = array(
            'customer' => array(
                'name' => $customer->name,
                'phone_number' => $customer->phone_number,
                'provinsi' => $customer->provinsi,
                'kabupaten' => $customer->kabupaten,
                'kecamatan' => $customer->kecamatan,
                'desa' => $customer->desa,
                'address' => $customer->address,
                'kode_pos' => $customer->kode_pos
            ),
            'shipping' => array(
                'courier' => 'jne', // Default courier
                'service' => 'REG' // Default service
            ),
            'note' => $note
        );

        $delivery_data = json_encode($delivery_data);

        $order = array(
            'user_id' => $user_id,
            'coupon_id' => $coupon_id,
            'order_number' => $order_number,
            'order_status' => 1,
            'order_date' => $order_date,
            'total_price' => $total_price,
            'total_items' => $total_items,
            'payment_method' => $payment,
            'delivery_data' => $delivery_data,
            'shipping_cost' => $shipping_cost,
            'courier' => $this->input->post('courier')
        );

        $order_id = $this->product->create_order($order);

        // Create order items
        $order_items = [];
        $n = 0;
        foreach ($items as $id => $data) {
            $order_items[$n]['order_id'] = $order_id;
            $order_items[$n]['product_id'] = $id;
            $order_items[$n]['order_qty'] = $data['qty'];
            $order_items[$n]['order_price'] = $data['price'];
            $n++;
        }

        $this->product->create_order_items($order_items);

        // Clear cart and session data
        $this->cart->destroy();
        $this->session->unset_userdata('coupon_id');

        $this->session->set_flashdata('order_flash', 'Order berhasil ditambahkan');
        redirect('customer/orders/view/'. $order_id);
    }
}
