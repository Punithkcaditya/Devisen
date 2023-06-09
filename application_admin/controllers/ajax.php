<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('page_types_model');
        $this->load->model('widget_areas_model');
        $this->load->model('menuitems_model');
    }

    public function getslug($model, $field, $text) {///
        $this->load->model($model);
        $slug = $this->$model->get_slug(urldecode($text), $field);
        $result = array("field_id" => $field, "field_val" => $slug);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function checkemail($model, $field, $text) {///
        $this->load->model($model);
        $value = $this->$model->get_row(urldecode($text), $field);
        $result = array("data" => $value, "status" => (!empty($value) ? 1 : ''));
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function getstates($country_id = 1) {
        $states = $this->states_model->get_states($country_id);
        header('Content-Type: application/json');
        echo json_encode($states);
    }

    public function widgetareas($template_id = 1) {
        $widgetareas = $this->widget_areas_model->get_widget_areas($template_id);
        header('Content-Type: application/json');
        echo json_encode($widgetareas);
    }

    public function widgetcontent($widget_type) {
        $this->page_types_model->primary_key = array('type_id' => $widget_type);
        $page_type = $this->page_types_model->get_row();
        $content_model = $page_type->model_name;
        $value_field = $page_type->value_field;
        $text_field = $page_type->text_field;
        $this->load->model($content_model);
        if ($widget_type == 8) {
            $this->$content_model->db->where('story_type', 1);
        } elseif ($widget_type == 9) {
            $this->$content_model->db->where('story_type', 2);
        } elseif ($widget_type == 10) {
            $this->$content_model->db->where('story_type', 4);
        } elseif ($widget_type == 11) {
            $this->$content_model->db->where('story_type', 3);
        } elseif ($widget_type == 20) {
            $this->$content_model->db->where('p.type_id', 20);
        }
        $result_array = $this->$content_model->view_widgets();
        $widgetcontent = array();
        foreach ($result_array as $result) {
            $widgetcontent[] = array('value' => $result->$value_field, 'text' => $result->$text_field);
        }
        header('Content-Type: application/json');
        echo json_encode($widgetcontent);
    }

    public function menuitems($menu_id = 1) {
        $menuitems = $this->menuitems_model->get_menuitems($menu_id, null);
        for ($i = 0; $i < count($menuitems); $i++) {
            $menuitems[$i]->submenu = $this->menuitems_model->get_menuitems($menu_id, $menuitems[$i]->menuitem_id);
        }
        //echo "<pre>"; print_r($menuitems); die();
        header('Content-Type: application/json');
        echo json_encode($menuitems);
    }

}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */
