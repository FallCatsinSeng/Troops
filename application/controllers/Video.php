<?php
defined('BASEPATH') OR exit('No direct script access allowed');

public function videos()
{
    $this->load->model('video_model', 'video');
    $data['title'] = 'Video Galeri';
    $data['videos'] = $this->video->get_all_videos();

    $this->load->view('themes/troopsApparel/header', $data);
    $this->load->view('themes/troopsApparel/video_gallery', $data);
    $this->load->view('themes/troopsApparel/footer');
}

}