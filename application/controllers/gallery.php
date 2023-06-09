<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('galleries_model');
        $this->load->model('photos_model');
        $this->load->model('videos_model');
    }

    public function index($page_slug, $month = '', $year = '') {
        $template_path = $this->pagewisecontent($page_slug);
        $data = $this->data;
        $data['photos_gallery'] = $this->galleries_model->photo_view();
        $data['videos_gallery'] = $this->galleries_model->video_view();
        $data['scripts'] = array('javascripts/common.js', 'javascripts/gallery.js');
        $this->load->view($template_path, $data);
    }

    public function photoindex($page_slug) {
        $template_path = $this->pagewisecontent($page_slug);
        $data = $this->data;
        $data['photos_gallery'] = $this->galleries_model->photo_view();
        $data['scripts'] = array('javascripts/common.js', 'javascripts/photos.js');
        $this->load->view($template_path, $data);
    }

    public function videoindex($page_slug) {
        $template_path = $this->pagewisecontent($page_slug);
        $data = $this->data;
        $data['videos_gallery'] = $this->galleries_model->video_view();
        $data['scripts'] = array('javascripts/common.js', 'javascripts/photos.js');
        $this->load->view($template_path, $data);
    }

    public function photodetails($page_slug, $gallery_slug) {
        $template_path = $this->pagewisecontent($page_slug);
        $data = $this->data;

        //Gallery Specific Page Title
        $this->galleries_model->primary_key = array('gallery_slug' => $gallery_slug);
        $gallery_info = $this->galleries_model->get_row();
        if (!empty($gallery_info)) {
            $data['gallery_info'] = $gallery_info;
            $gallery_id = $gallery_info->gallery_id;
            $data['gallery_id'] = $gallery_id;
            $data['photo_items'] = $this->photos_model->gallery($gallery_id);
            $data['page_items']->page_title = $gallery_info->gallery_name;
            $data['page_items']->page_content = $gallery_info->description;
            $data['page_items'] = (object) array_merge((array) $data['page_items'], (array) $gallery_info);
            $data['scripts'] = array('javascripts/common.js', 'javascripts/photos.js');
            $data['view_path'] = 'gallery/photo_more';
            $this->load->view($template_path, $data);
        } else {
            redirect("/photo-galleries/");
        }
    }

    public function videodetails($page_slug, $gallery_slug, $video_slug = null) {
        $template_path = $this->pagewisecontent($page_slug);
        $data = $this->data;
        //Gallery Specific Page Title
        if (!empty($video_slug)) {
            $this->videos_model->primary_key = array('video_slug' => $video_slug);
            $data['video'] = $this->videos_model->get_row();
        }
        $this->galleries_model->primary_key = array('gallery_slug' => $gallery_slug);
        $gallery_info = $this->galleries_model->get_row();
        if (!empty($gallery_info)) {
            $data['video_items'] = $this->videos_model->video_gallery($gallery_info->gallery_id);
            $data['gallery_info'] = $gallery_info;
            $gallery_id = $gallery_info->gallery_id;
            $data['gallery_id'] = $gallery_id;
            $data['videos'] = $this->videos_model->gallery($gallery_id);
            $data['page_items']->page_title = $gallery_info->gallery_name;
            $data['page_items']->page_content = $gallery_info->description;
            $data['page_items'] = (object) array_merge((array) $data['page_items'], (array) $gallery_info);
            $data['scripts'] = array('javascripts/common.js', 'javascripts/photos.js');
            $data['view_path'] = 'gallery/video_more';
            $this->load->view($template_path, $data);
        } else {
            redirect("/video-galleries/");
        }
    }

}