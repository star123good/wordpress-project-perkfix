<?php

// First, create a function that includes the path to your favicon
function add_favicon() {
    $favicon_url = get_stylesheet_directory_uri()."/img/perkfix-logo.png";
    echo '<link rel="icon" href="' . $favicon_url . '" />';
}

// Now, just make sure that function runs when you're on the login page and admin pages  
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');

// Add code here.
add_action('rest_api_init', function() {
    register_rest_route( 'perkstore/v1', 'search-results/(?P<category_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_search_results_by_category',
        'args' => array(
            'category_id' => array(
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            )
        )
    ));

    register_rest_route( 'perkstore/v1', 'item-detail/(?P<category_id>\d+)/(?P<product_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_product_detail',
        'args' => array(
            'category_id' => array(
                'validate_callack' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            )
        )
    ));
});

function get_search_results_by_category($request) {
    $args = array(
        'category' => $request['category_id'],
        'post_type' => 'perks'
    );

    $perks = get_posts($args);
    if (empty($perks)) {
        return new WP_Error('empty_category', 'there is no perk in this category', array('status' => 404));
    }

    $response = new WP_REST_Response($perks);
    $response->set_status(200);

    return $response;
}

function get_product_detail($request) {
    $ret = array();
    $category_id = $request['category_id'];
    $product_id = $request['product_id'];

    $icon_image_id = get_term_meta($category_id, 'pix_term_icon', true);
    $ret['icon_image_url'] = wp_get_attachment_url($icon_image_id);
    $ret['cat_name'] = get_cat_name($category_id);
    $ret['button_link'] = get_field('button_link', $product_id);
    $ret['button_text'] = get_field('button_text', $product_id);
    $ret['compatible_devices'] = get_field('compatible_devices', $product_id);
    $ret['currency_symbol'] = get_field('currency_symbol', $product_id);
    $ret['note'] = get_field('note', $product_id);
    $ret['perk_detail'] = get_field('perk_detail', $product_id);
    $ret['perk_name'] = get_field('perk_name', $product_id);
    $ret['price'] = get_field('price', $product_id);
    $ret['cosmetic_image_1'] = get_field('cosmetic_image_1', $product_id);
    $ret['cosmetic_image_2'] = get_field('cosmetic_image_2', $product_id);
    $ret['cosmetic_image_3'] = get_field('cosmetic_image_3', $product_id);
    $ret['provider_website_link'] = get_field('provider_website_link', $product_id);
    $ret['compatible_devices_link'] = get_field('compatible_devices_link', $product_id);
    $ret['helpful_information_title_1'] = get_field('helpful_information_title_1', $product_id);
    $ret['helpful_information_link_1'] = get_field('helpful_information_link_1', $product_id);
    $ret['helpful_information_title_2'] = get_field('helpful_information_title_2', $product_id);
    $ret['helpful_information_link_2'] = get_field('helpful_information_link_2', $product_id);
    $ret['price_type'] = get_field('price_type', $product_id);
    $ret['product_image_url'] = wp_get_attachment_url(get_post_thumbnail_id($product_id));
    $response = new WP_REST_Response($ret);
    $response->set_status(200);
    return $response;
}

function mysite_js() {
    wp_enqueue_script('autocomplete', get_stylesheet_directory_uri().'/js/jquery.auto-complete.js', array('jquery'));
    wp_enqueue_script('mysite-js', get_stylesheet_directory_uri().'/js/mysite.js', array('jquery', 'autocomplete'));
    wp_enqueue_style('autocomplete.css', get_stylesheet_directory_uri().'/js/jquery.auto-complete.css');
}

add_action('wp_enqueue_scripts', 'mysite_js');

add_action('wp_ajax_nopriv_get_perkfix_names', 'ajax_listings');
add_action('wp_ajax_get_perkfix_names', 'ajax_listings');

function ajax_listings() {
    global $wpdb;

    $name = $wpdb->esc_like(stripslashes($_POST['k'])).'%';
    $sql = "select post_title from $wpdb->posts where post_title like %s and post_type='perks' and post_status='publish'";

    $sql = $wpdb->prepare($sql, $name);

    $results = $wpdb->get_results($sql);

    $titles = array();
    foreach( $results as $r)
        $titles[] = addslashes($r->post_title);

    echo json_encode($titles);

    die();
}

function my_login_logo_one() { 
?> 
<style type="text/css"> 
body.login div#login h1 a {
    background-image: url(<?php echo get_stylesheet_directory_uri()."/img/perkfix-logo.png"; ?>); 
    padding-bottom: 30px; 
} 
</style>
    <?php 
} add_action( 'login_enqueue_scripts', 'my_login_logo_one' );