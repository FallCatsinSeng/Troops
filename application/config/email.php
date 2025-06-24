<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'yugu780@gmail.com'; // Email yang akan digunakan untuk mengirim verifikasi
$config['smtp_pass'] = 'hbsl ypub edni nvfd'; // Password aplikasi dari Gmail
$config['smtp_crypto'] = 'tls';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['wordwrap'] = TRUE; 