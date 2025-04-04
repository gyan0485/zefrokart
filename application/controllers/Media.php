<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
defined('BASEPATH') or exit('No direct script access allowed');


class Media extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'language', 'timezone_helper']);
        $this->load->library(['Jwt', 'Key', 'upload','pagination']);
        $this->load->model(['address_model', 'category_model', 'product_model', 'brand_model', 'cart_model', 'faq_model', 'blog_model', 'ion_auth_model']);
        // $this->load->library(['pagination']);
        $this->data['is_logged_in'] = ($this->ion_auth->logged_in()) ? 1 : 0;
        $this->data['user'] = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row() : array();
        $this->data['settings'] = get_settings('system_settings', true);
        $this->data['web_settings'] = get_settings('web_settings', true);
        $this->data['auth_settings'] = get_settings('authentication_settings', true);
        $this->data['web_logo'] = get_settings('web_logo');
        // $this->data['auth_settings'] = get_settings('authentication_settings', true);
        $this->response['csrfName'] = $this->security->get_csrf_token_name();
        $this->response['csrfHash'] = $this->security->get_csrf_hash();
    }

    // public function index()
    // {

    //     $this->data['main_page'] = 'home';
    //     $this->data['title'] = 'Home | ' . $this->data['web_settings']['site_title'];
    //     $this->data['keywords'] = 'Home, ' . $this->data['web_settings']['meta_keywords'];
    //     $this->data['description'] = 'Home | ' . $this->data['web_settings']['meta_description'];

    //     $limit =  12;
    //     $offset =  0;
    //     $sort = 'row_order';
    //     $order =  'ASC';
    //     $has_child_or_item = 'false';
    //     $filters = [];
    //     /* Fetching Categories Sections */
    //     $categories = $this->category_model->get_categories('', $limit, $offset, $sort, $order, 'false');
    //     $brands = $this->brand_model->get_brands('', $limit, $offset, $sort, $order, 'false');
    //     // echo "<pre>";
    //     // print_r($brands);
    //     // die;
    //     /* Fetching Featured Sections */

    //     $sections = $this->db->limit($limit, $offset)->order_by('row_order')->get('sections')->result_array();

    //     $user_id = NULL;
    //     if ($this->data['is_logged_in']) {
    //         $user_id = $this->data['user']->id;
    //     }
    //     $filters['show_only_active_products'] = true;
    //     if (!empty($sections)) {
    //         for ($i = 0; $i < count($sections); $i++) {
    //             $product_ids = isset($sections[$i]['product_ids']) ? explode(',', (string)$sections[$i]['product_ids']) : '';
    //             $product_ids = array_filter((array)$product_ids);

    //             $product_categories = (isset($sections[$i]['categories']) && !empty($sections[$i]['categories']) && $sections[$i]['categories'] != NULL) ? explode(',', $sections[$i]['categories']) : null;
    //             if (isset($sections[$i]['product_type']) && !empty($sections[$i]['product_type'])) {
    //                 $filters['product_type'] = (isset($sections[$i]['product_type'])) ? $sections[$i]['product_type'] : null;
    //             }

    //             $theme = fetch_details('themes', ['is_default' => 1], 'name');
    //             // print_r($theme);

    //             if (isset($theme[0]['name']) && strtolower($theme[0]['name']) == 'modern') {
    //                 if ($sections[$i]['style'] == "default" || $sections[$i]['style'] == "style_3") {
    //                     $limit = 4;
    //                 } elseif ($sections[$i]['style'] == "style_1" || $sections[$i]['style'] == "style_2" || $sections[$i]['style'] == "style_4") {
    //                     $limit = 8;
    //                 } else {
    //                     $limit = null;
    //                 }
    //             } else {
    //                 if ($sections[$i]['style'] == "default") {
    //                     $limit = 10;
    //                 } elseif ($sections[$i]['style'] == "style_1" || $sections[$i]['style'] == "style_2") {
    //                     $limit = 4;
    //                 } elseif ($sections[$i]['style'] == "style_3" || $sections[$i]['style'] == "style_4") {
    //                     $limit = 5;
    //                 } else {
    //                     $limit = null;
    //                 }
    //             }

    //             $products = fetch_product($user_id, (isset($filters)) ? $filters : null, (isset($product_ids)) ? $product_ids : null, $product_categories, $limit, null, null, null);
    //             // echo "<pre>";
    //             // print_R($products);
    //             // die;
    //             $sections[$i]['title'] =  output_escaping($sections[$i]['title']);
    //             $sections[$i]['slug'] =  url_title($sections[$i]['title'], 'dash', true);
    //             $sections[$i]['short_description'] =  output_escaping($sections[$i]['short_description']);
    //             $sections[$i]['filters'] = (isset($products['filters'])) ? $products['filters'] : [];
    //             $sections[$i]['product_details'] =  $products['product'];
    //             unset($sections[$i]['product_details'][0]['total']);
    //             $sections[$i]['product_details'] = $products['product'];
    //             unset($product_details);
    //         }
    //     }

    //     $this->data['sections'] = $sections;
    //     $this->data['categories'] = $categories;
    //     $this->data['brands'] = $brands;
    //     $this->data['username'] = $this->session->userdata('username');
    //     $this->data['sliders'] = get_sliders();
    //     $this->load->view('front-end/' . THEME . '/template', $this->data);
    // }


    public function image()
    {

        try {
            // Get input parameters
            $path = $this->input->get("path");
            $width = $this->input->get("width");
            $height = $this->input->get("height");
            $quality = $this->input->get("quality") ? $this->input->get("quality") : '100';

            $segment = explode(".", $path);

            $ext = end($segment);
            
            if(in_array(strtolower($ext), $this->config->config["excluded_resize_extentions"])){
                header('Content-Type: image/gif');
                $gifFile = $path;
                readfile($gifFile);
                die;
            }


            // Check if any input parameter is missing
            if (!$path || !$width) {
                throw new Exception("Missing required input parameters");
            }

            // Load image library
            $this->load->library("image_lib");

            // Resize the original image
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = true;
            $config['create_thumb'] = FALSE;
            $config['source_image'] =  $path;
            $config['dynamic_output'] = true;
            $config['quality'] = $quality;
            $config['width'] = $width;
            $config['height'] = $height;

            $this->image_lib->initialize($config);

            if (!$this->image_lib->resize()) {
                throw new Exception($this->image_lib->display_errors());
            }
            $this->image_lib->clear();

            // If everything is successful, return success message
            // echo "Image resized successfully";
        } catch (Exception $e) {
            // If an exception occurred, return error message
            echo "Error: " . $e->getMessage();
        }
    }
}
