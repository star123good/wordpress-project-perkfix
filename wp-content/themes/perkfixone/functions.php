<?php
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
    $ret['category_id'] = $request['category_id'];
    $ret['product_id'] = $request['product_id'];

    $response = new WP_REST_Response($ret);
    $response->set_status(200);
    return $response;
}