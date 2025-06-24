<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Courier API Configuration
|--------------------------------------------------------------------------
|
| This file contains the API keys and configurations for various courier
| services used for tracking shipments.
|
*/

$config['jne_api_key'] = 'YOUR_JNE_API_KEY';
$config['jne_api_url'] = 'https://api.jne.co.id/tracking';

$config['jnt_api_key'] = 'YOUR_JNT_API_KEY';
$config['jnt_api_url'] = 'https://api.jet.co.id/tracking';

$config['sicepat_api_key'] = 'YOUR_SICEPAT_API_KEY';
$config['sicepat_api_url'] = 'https://api.sicepat.com/tracking';

$config['anteraja_api_key'] = 'YOUR_ANTERAJA_API_KEY';
$config['anteraja_api_url'] = 'https://api.anteraja.id/tracking'; 