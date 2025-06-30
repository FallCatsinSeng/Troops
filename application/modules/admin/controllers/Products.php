<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'product_model' => 'product',
            'order_model' => 'order'
        ));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $params['title'] = 'Kelola Produk '. get_store_name();

        $config['base_url'] = site_url('admin/products/index');
        $config['total_rows'] = $this->product->count_all_products();
        $config['per_page'] = 16;
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
 
        $products['products'] = $this->product->get_all_products($config['per_page'], $page);
        $products['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $params);
        $this->load->view('products/products', $products);
        $this->load->view('footer');
    }

    public function search()
    {
        $query = $this->input->get('search_query');
        $query = html_escape($query);

        $params['title'] = 'Cari "'. $query .'"';
        $params['query'] = $query;

        $config['base_url'] = site_url('admin/products/search');
        $config['total_rows'] = $this->product->count_all_products();
        $config['per_page'] = 16;
        $config['uri_segment'] = 4;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);
 
        $config['first_link']       = '«';
        $config['last_link']        = '»';
        $config['next_link']        = '›';
        $config['prev_link']        = '‹';
        $config['reuse_query_string'] = TRUE;
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
 
        $products['products'] = $this->product->search_products($query, $config['per_page'], $page);
        $products['pagination'] = $this->pagination->create_links();
        $products['count'] = $this->product->count_search($query);

        $this->load->view('header', $params);
        $this->load->view('products/search', $products);
        $this->load->view('footer');
    }

    public function add_new_product()
    {
        $params['title'] = 'Tambah Produk Baru';

        $product['flash'] = $this->session->flashdata('add_new_product_flash');
        $product['categories'] = $this->product->get_all_categories();

        $this->load->view('header', $params);
        $this->load->view('products/add_new_product', $product);
        $this->load->view('footer');
    }

    public function add_product()
    {
        $this->form_validation->set_error_delimiters('<div class="form-error text-danger font-weight-bold">', '</div>');

        $this->form_validation->set_rules('name', 'Nama produk', 'trim|required|min_length[4]|max_length[255]');
        $this->form_validation->set_rules('price', 'Harga produk', 'trim|required');
        $this->form_validation->set_rules('stock', 'Stok barang', 'required|numeric');
        $this->form_validation->set_rules('weight', 'Berat barang', 'required|numeric');
        $this->form_validation->set_rules('description', 'Deskripsi produk', 'max_length[512]');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->add_new_product();
        }
        else
        {
            $name = $this->input->post('name');
            $category_id = $this->input->post('category_id');
            $price = $this->input->post('price');
            $stock = $this->input->post('stock');
            $weight = $this->input->post('weight');
            $desc = $this->input->post('description');
            $date = date('Y-m-d H:i:s');

            $config['upload_path'] = './assets/uploads/products/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);
            $uploaded_files = array();

            // Handle multiple file uploads
            $files = $_FILES;
            $count = count($_FILES['pictures']['name']);

            if ($count < 2) {
                $this->session->set_flashdata('add_new_product_flash', 'Minimal harus upload 2 gambar!');
                redirect('admin/products/add_new_product');
                return;
            }

            if ($count > 3) {
                $this->session->set_flashdata('add_new_product_flash', 'Maksimal hanya 3 gambar yang diperbolehkan!');
                redirect('admin/products/add_new_product');
                return;
            }

            for($i = 0; $i < $count; $i++) {
                $_FILES['picture']['name'] = $files['pictures']['name'][$i];
                $_FILES['picture']['type'] = $files['pictures']['type'][$i];
                $_FILES['picture']['tmp_name'] = $files['pictures']['tmp_name'][$i];
                $_FILES['picture']['error'] = $files['pictures']['error'][$i];
                $_FILES['picture']['size'] = $files['pictures']['size'][$i];

                $config['file_name'] = time() . '_' . $i;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('picture')) {
                    $upload_data = $this->upload->data();
                    $uploaded_files[] = $upload_data['file_name'];
                }
            }

            if (empty($uploaded_files)) {
                $this->session->set_flashdata('add_new_product_flash', 'Gagal mengupload gambar!');
                redirect('admin/products/add_new_product');
                return;
            }

            $category_data = $this->product->category_data($category_id);
            $category_name = $category_data->name;

            $sku = create_product_sku($name, $category_name, $price, $stock);

            $product['category_id'] = $category_id;
            $product['sku'] = $sku;
            $product['name'] = $name;
            $product['description'] = $desc;
            $product['price'] = $price;
            $product['stock'] = $stock;
            $product['weight'] = $weight;
            $product['picture_name'] = implode(',', $uploaded_files);
            $product['add_date'] = $date;

            $this->product->add_new_product($product);
            $this->session->set_flashdata('add_new_product_flash', 'Produk baru berhasil ditambahkan!');

            redirect('admin/products/add_new_product');
        }
    }

    public function edit($id = 0)
    {
        if ( $this->product->is_product_exist($id))
        {
            $data = $this->product->product_data($id);

            $params['title'] = 'Edit '. $data->name;

            $product['flash'] = $this->session->flashdata('edit_product_flash');
            $product['product'] = $data;
            $product['categories'] = $this->product->get_all_categories();

            $this->load->view('header', $params);
            $this->load->view('products/edit_product', $product);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function edit_product()
    {
        $this->form_validation->set_error_delimiters('<div class="form-error text-danger font-weight-bold">', '</div>');

        $this->form_validation->set_rules('name', 'Nama produk', 'trim|required|min_length[4]|max_length[255]');
        $this->form_validation->set_rules('price', 'Harga produk', 'trim|required');
        $this->form_validation->set_rules('stock', 'Stok barang', 'required|numeric');
        $this->form_validation->set_rules('weight', 'Berat barang', 'required|numeric');
        $this->form_validation->set_rules('description', 'Deskripsi produk', 'max_length[512]');
        
        if ($this->form_validation->run() == FALSE)
        {
            $id = $this->input->post('id');
            $this->edit($id);
        }
        else
        {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $category_id = $this->input->post('category_id');
            $price = $this->input->post('price');
            $stock = $this->input->post('stock');
            $weight = $this->input->post('weight');
            $desc = $this->input->post('description');
            $available = $this->input->post('is_available');

            $product['category_id'] = $category_id;
            $product['name'] = $name;
            $product['description'] = $desc;
            $product['price'] = $price;
            $product['stock'] = $stock;
            $product['weight'] = $weight;
            $product['is_available'] = ($available) ? 1 : 0;

            if (isset($_FILES['picture']) && $_FILES['picture']['name'] != '')
            {
                $data = $this->product->product_data($id);
                $picture_name = $data->picture_name;

                if (file_exists('./assets/uploads/products/'. $picture_name))
                    unlink('./assets/uploads/products/'. $picture_name);
                
                $config['upload_path'] = './assets/uploads/products/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['file_name'] = time();
        
                $this->load->library('upload', $config);
        
                if ( $this->upload->do_upload('picture'))
                {
                    $upload_data = $this->upload->data();
                    $product['picture_name'] = $upload_data['file_name'];
                }
            }
            
            $this->product->edit_product($id, $product);
            $this->session->set_flashdata('edit_product_flash', 'Produk berhasil diperbarui!');

            redirect('admin/products/edit/'. $id);
        }
    }

    public function product_api()
    {
        $action = $this->input->get('action');

        switch ($action) {
            case 'delete_image':
                $id = $this->input->post('id');
                $data = $this->product->product_data($id);
                $picture_name = $data->picture_name;

                if (file_exists('./assets/uploads/products/'. $picture_name)) {
                    if (unlink('./assets/uploads/products/'. $picture_name)) {
                        $this->product->delete_image($id);
                        $response = array('code' => 204, 'message' => 'Gambar berhasil dihapus');
                    }
                    else {
                        $response = array('code' => 200, 'message' => 'Gagal menghapus gambar');
                    }
                }
                
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                break;
            case 'delete_product':
                $id = $this->input->post('id');
                $data = $this->product->product_data($id);
                $picture_name = $data->picture_name;
                $this->product->delete_product($id);

                if (file_exists('./assets/uploads/products/'. $picture_name)) {
                    unlink('./assets/uploads/products/'. $picture_name);
                }

                $this->order->delete_all_items($id);

                $response = array('code' => 204);

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                break;
        }
    }

    public function view($id = 0)
    {
        if ( $this->product->is_product_exist($id))
        {
            $params['title'] = 'Review Produk';
            $params['product'] = $this->product->product_data($id);
            $params['flash'] = $this->session->flashdata('view_product_flash');
            $params['orders'] = $this->order->product_ordered($id);

            $this->load->view('header', $params);
            $this->load->view('products/view', $params);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function category()
    {
        $params['title'] = 'Kelola Kategori';

        $this->load->view('header', $params);
        $this->load->view('products/category');
        $this->load->view('footer');
    }

    public function category_api()
    {
        $action = $this->input->get('action');

        switch ($action)
        {
            case 'list' :
                $cats = $this->product->get_all_categories();
                $n = 1;

                foreach ($cats as $cat)
                {
                    $cat->no = $n;
                    $n++;
                }

                $category['data'] = $cats;
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($category));
                break;
            case 'add_category' :
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                $this->form_validation->set_rules('name', 'Nama', 'required|max_length[100]');

                if ($this->form_validation->run() == FALSE)
                {
                    $response = array(
                        'code' => 400,
                        'errors' => array(
                            'name' => form_error('name')
                        )
                    );

                    $this->output
                        ->set_status_header(400)
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                }
                else
                {
                    $name = $this->input->post('name');

                    $this->product->add_new_category($name);
                    $response = array('code' => 201);

                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                }

                break;
            case 'delete_category' :
                $id = $this->input->post('id');
                $this->product->delete_category($id);

                $response = array('code' => 204);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                break;
            case 'view_data' :
                $id = $this->input->get('id');

                $data['data'] = $this->product->category_data($id);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
                break;
            case 'edit_category' :
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                $this->form_validation->set_rules('name', 'Nama', 'required|max_length[100]');

                if ($this->form_validation->run() == FALSE)
                {
                    $response = array(
                        'code' => 400,
                        'errors' => array(
                            'name' => form_error('name')
                        )
                    );

                    $this->output
                        ->set_status_header(400)
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                }
                else
                {
                    $id = $this->input->post('id');
                    $name = $this->input->post('name');
                    $this->product->edit_category($id, $name);

                    $response = array('code' => 201);
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                }
                break;
        }
    }

    public function coupons()
    {
        $params['title'] = 'Kelola Kupon';

        $this->load->view('header', $params);
        $this->load->view('products/coupons');
        $this->load->view('footer');
    }

    public function _get_coupon_list()
    {
        $coupons = $this->product->get_all_coupons();
        $n = 1;

        foreach ($coupons as $coupon)
        {
            $coupon->no = $n;
            $coupon->credit = 'Rp'. format_rupiah($coupon->credit);
            $coupon->start_date = get_formatted_date($coupon->start_date);
            $coupon->expired_date = get_formatted_date($coupon->expired_date);
            $coupon->is_active = ($coupon->is_active == 1) ? 'Aktif' : 'Tidak aktif';

            $n++;
        }

        return $coupons;
    }

    public function coupon_api()
    {
        $action = $this->input->get('action');

        switch ($action) {
            case 'coupon_list' :
                $coupons['data'] = $this->product->get_all_coupons();

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($coupons));
                break;
            case 'add_coupon' :
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
                $this->form_validation->set_rules('code', 'Kode', 'required|max_length[255]|is_unique[coupons.code]');
                $this->form_validation->set_rules('credit', 'Potongan', 'required|numeric');
                $this->form_validation->set_rules('start_date', 'Tanggal mulai', 'required');
                $this->form_validation->set_rules('expired_date', 'Tanggal kadaluarsa', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                    $response = array(
                        'code' => 400,
                        'errors' => array(
                            'name' => form_error('name'),
                            'code' => form_error('code'),
                            'credit' => form_error('credit'),
                            'start_date' => form_error('start_date'),
                            'expired_date' => form_error('expired_date')
                        )
                    );

                    $this->output
                        ->set_status_header(400)
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                }
                else
                {
                    $name = $this->input->post('name');
                    $code = $this->input->post('code');
                    $credit = $this->input->post('credit');
                    $start_date = $this->input->post('start_date');
                    $expired_date = $this->input->post('expired_date');

                    $data = array(
                        'name' => $name,
                        'code' => $code,
                        'credit' => $credit,
                        'start_date' => $start_date,
                        'expired_date' => $expired_date,
                        'is_active' => 1
                    );

                    $this->product->add_coupon($data);
                    $response = array(
                        'code' => 200,
                        'data' => $data);

                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                }
                break;
            case 'delete_coupon' :
                $id = $this->input->post('id');
                $this->product->delete_coupon($id);
                
                $response = array('code' => 204);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                break;
            case 'view_data' :
                $id = $this->input->get('id');
                $data['data'] = $this->product->coupon_data($id);

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
                break;
            case 'edit_coupon' :
                $id = $this->input->post('id');
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('name', 'Nama', 'required|max_length[255]');
                $this->form_validation->set_rules('code', 'Kode', 'required|max_length[255]');
                $this->form_validation->set_rules('credit', 'Potongan', 'required|numeric');
                $this->form_validation->set_rules('start_date', 'Tanggal mulai', 'required');
                $this->form_validation->set_rules('expired_date', 'Tanggal kadaluarsa', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                    $response = array(
                        'code' => 400,
                        'errors' => array(
                            'name' => form_error('name'),
                            'code' => form_error('code'),
                            'credit' => form_error('credit'),
                            'start_date' => form_error('start_date'),
                            'expired_date' => form_error('expired_date')
                        )
                    );

                    $this->output
                        ->set_status_header(400)
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                }
                else
                {
                    $name = $this->input->post('name');
                    $code = $this->input->post('code');
                    $credit = $this->input->post('credit');
                    $start_date = $this->input->post('start_date');
                    $expired_date = $this->input->post('expired_date');
                    $is_active = ($this->input->post('is_active')) ? 1 : 0;

                    $data = array(
                        'name' => $name,
                        'code' => $code,
                        'credit' => $credit,
                        'start_date' => $start_date,
                        'expired_date' => $expired_date,
                        'is_active' => $is_active
                    );

                    $this->product->edit_coupon($id, $data);
                    $response = array(
                        'code' => 201,
                        'data' => $data
                    );

                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                }
                break;
        }
    }
}

