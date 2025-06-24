<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biteship {
    protected $ci;
    protected $api_key;
    protected $api_url;
    protected $origin_postal_code;

    public function __construct()
    {
        $this->ci =& get_instance();
        
        // Load config
        $this->ci->load->config('biteship');
        
        $this->api_key = $this->ci->config->item('biteship_api_key');
        $this->api_url = $this->ci->config->item('biteship_api_url');
        $this->origin_postal_code = $this->ci->config->item('biteship_origin_postal_code');
    }

    /**
     * Get available couriers
     */
    public function get_couriers()
    {
        $url = $this->api_url . '/couriers';
        
        $response = $this->_make_request('GET', $url);
        return $response;
    }

    /**
     * Get locations by query
     */
    public function get_locations($query)
    {
        $url = $this->api_url . '/locations';
        $params = ['query' => $query];
        
        $response = $this->_make_request('GET', $url, $params);
        return $response;
    }

    /**
     * Get shipping rates
     */
    public function get_rates($params)
    {
        $url = $this->api_url . '/rates/couriers';
        
        $response = $this->_make_request('POST', $url, $params);
        return $response;
    }

    /**
     * Make HTTP request to Biteship API
     */
    private function _make_request($method, $url, $params = [])
    {
        $curl = curl_init();

        $headers = [
            'Authorization: Bearer ' . $this->api_key,
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        $curl_options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers
        ];

        if ($method === 'POST') {
            $curl_options[CURLOPT_POSTFIELDS] = json_encode($params);
        } elseif (!empty($params)) {
            $curl_options[CURLOPT_URL] .= '?' . http_build_query($params);
        }

        curl_setopt_array($curl, $curl_options);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return [
                'success' => false,
                'message' => $err
            ];
        }

        return json_decode($response, true);
    }
} 