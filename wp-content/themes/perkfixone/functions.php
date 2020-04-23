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
    register_rest_route( 'perkstore/v1', 'search-results', array(
        'methods' => 'POST',
        'callback' => 'get_search_results'
    ));

    register_rest_route( 'perkstore/v1', 'item-detail/(?P<category_id>\d+)/(?P<product_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_product_detail',
        'args' => array(
            'category_id' => array(
                'validate_callack' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
            'product_id' => array(
                'validate_callack' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            )
        )
    ));

    register_rest_route( 'perkstore/v1', 'item-list/(?P<category_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_product_list',
        'args' => array(
            'category_id' => array(
                'validate_callack' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            )
        )
    ));

    register_rest_route( 'perkstore/v1', 'get_started', array(
        'methods' => 'POST',
        'callback' => 'post_get_started'
    ));

    register_rest_route( 'perkstore/v1', 'send_email', array(
        'methods' => 'GET',
        'callback' => 'send_email'
    ));

    register_rest_route( 'perkstore/v1', 'contact_us', array(
        'methods' => 'POST',
        'callback' => 'post_contact_us'
    ));
});

function get_search_results($request) {
    global $wpdb;

    $keyword = '%'.$wpdb->esc_like(stripslashes($request['keyword'])).'%';
    $sql = "SELECT * FROM $wpdb->posts WHERE post_title LIKE %s AND post_type='perks' AND post_status = 'publish'";
    $sql = $wpdb->prepare($sql, $keyword);
    $post_results = $wpdb->get_results($sql);
    
    $tag_query = array( 'tag' => $keyword, 'post_type' => 'perks' );
    $tag_results = get_posts( $tag_query );

    $results = array_merge($post_results, $tag_results);

    $html = "";
    $cat_id = '';

    // if no result
    if (count($results) == 0) {
        $html .= "<h2>No results</h2>";
    } else if (count($results) > 0) {
        foreach($results as $item) {
            $category = get_the_category($item->ID);
            if (count($category) > 0) {
                $perk_name = get_field('perk_name', $item->ID);
                $perk_desc = get_field('perk_detail', $item->ID);
                $provider_link = get_field('provider_website_link', $item->ID);
                $button_link = get_field('button_link', $item->ID);
                $button_text = get_field('button_text', $item->ID);
                $price = get_field('price', $item->ID);
                $currency_symbol = get_field('currency_symbol', $item->ID);
                $price_type = get_field('price_type', $item->ID);
                $cosmetic_image = get_field('cosmetic_image_1', $item->ID);

                $btn_link_text = "window.open('".$button_link."', '_blank')";
            
                $html .= "
                    <div class='item'>
                        <input type='hidden' id='sh_".$item->ID."' class='prod' value='".$item->ID."' />
                        <input type='hidden' id='sh_".$category[0]->cat_ID."' class='cat' value='".$category[0]->cat_ID."' />
                        <div class='item-detail'>
                            <div class='item-detail-image'>
                                <img src='".get_the_post_thumbnail_url($item)."'>
                            </div>
                            <div class='item-detail-text'>
                                <div class='pf-item-text'>
                                    <div class='item-title'>
                                        <b>".$perk_name."</b>
                                    </div>
                                    <div class='item-desc'>".$perk_desc."</div>
                                    <div class='item-provide'>
                                        <a href='".$provider_link."' target='_blank'>Provider Website</a>
                                    </div>
                                </div>
                                <div class='pf-item-button'>
                                    <button class='btn-pink btn-rd' onclick=\"".$btn_link_text."\">".$button_text."</button>
                                    <div class='item-price'>".$currency_symbol.$price."/".$price_type."</div>
                                </div>
                            </div>
                        </div>
                        <div class='item-cos-image'>
                            <img src='".$cosmetic_image."'>
                        </div>
                    </div>";
            }
        }
    }
    $response = new WP_REST_Response($html);
    $response->set_status(200);

    return $response;
}

function get_product_list($request) {
    $ret = array();
    $category_id = $request['category_id'];

    if ($category_id == 0) {
        $current_cat = get_category_by_slug('popular-perks');
    } else {
        $current_cat = get_category($category_id);
    }
    $args = array('category' => $current_cat->term_id, 'post_type' => 'perks', 'posts_per_page' => 1000);
    $current_perkslist = get_posts($args);

    $editor_image_1 = get_field('editor_image_1', 'category_'.$current_cat->term_id);
    $editor_image_2 = get_field('editor_image_2', 'category_'.$current_cat->term_id);
    $html = "";
    $html = "<div class='d-btn-back hidden'>
                <a class='w-btn-back'><i class='fas fa-chevron-left'></i></a>
            </div>
            <div class='item-title-container'>
                <div class='item-title-label'>
                    <h1>".$current_cat->name."</h1>
                </div>
                <div class='pf-search'>
                    <div class='td input'>
                        <input type='text' id='pf_search' placeholder='Search for perks like “ClassPass”' />
                    </div>
                    <div class='td submit'>
                        <button type='button' class='search' id='btn_search'>
                            <img src='".get_template_directory_uri()."/img/ico/ico-search-perkstore.png'>
                        </button>
                        <button type='button' class='close hidden' id='btn_close'>
                            <img src='".get_template_directory_uri()."/img/ico/ico-search-close.png'>
                        </button>
                    </div>
                </div>
            </div>
            <hr/>
            <div class='item-content-container'>
                <div class='item-content-label'>
                    <p>Editor's Pick</p>
                </div>
                <div class='item-perkstore-image'>
                    <div class='img-left'>";
                    if ($editor_image_1) {
                        $html .= "<img class='top-left' src='".$editor_image_1."'>";
                    } else {
                        $html .= "<img class='top-left' src=''>";
                    }
    if (isset($current_perkslist[0])) { 
        $top1_item_meta = get_post_meta($current_perkslist[0]->ID);

        $html .= "<div class='top-item'>
                    <input type='hidden' id='h_top_".$current_perkslist[0]->ID."' class='prod' value='".$current_perkslist[0]->ID."' />
                    <input type='hidden' id='h_top_".$category_id."' class='cat' value='".$category_id."' />
                    <div class='pf-item-image'>
                        <img src='".get_the_post_thumbnail_url($current_perkslist[0])."'>
                    </div>
                    <div class='pf-item-detail-container'>
                        <div class='pf-item-detail'>
                            <div class='pf-item-text'>
                                <div class='item-title'><b>".$top1_item_meta['perk_name'][0]."</b></div>
                                <div class='item-desc'>";
                                    $html .= $top1_item_meta['perk_detail'][0]; 
                      $html .= "</div>
                                <div class='item-price'>";
                                    $html .= $top1_item_meta['currency_symbol'][0].$top1_item_meta['price'][0]."/".get_field('price_type', $current_perkslist[0]->ID);   
                      $html .= "</div>
                            </div>
                            <div class='pf-item-button'>
                                <button onclick=\"window.open('".$top1_item_meta['button_link'][0]."', '_blank')\" class='btn-pink btn-rd'>".$top1_item_meta['button_text'][0]."</button>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    if (isset($current_perkslist[2])) { 
        $top3_item_meta = get_post_meta($current_perkslist[2]->ID);

        $html .= "<div class='top-item'>
                    <input type='hidden' id='h_top_".$current_perkslist[2]->ID."' class='prod' value='".$current_perkslist[2]->ID."' />
                    <input type='hidden' id='h_top_".$category_id."' class='cat' value='".$category_id."' />
                    <div class='pf-item-image'>
                        <img src='".get_the_post_thumbnail_url($current_perkslist[2])."'>
                    </div>
                    <div class='pf-item-detail-container'>
                        <div class='pf-item-detail'>
                            <div class='pf-item-text'>
                                <div class='item-title'><b>".$top3_item_meta['perk_name'][0]."</b></div>
                                <div class='item-desc'>";
                                    $html .= $top3_item_meta['perk_detail'][0]; 
                      $html .= "</div>
                                <div class='item-price'>";
                                    $html .= $top3_item_meta['currency_symbol'][0].$top3_item_meta['price'][0]."/".get_field('price_type', $current_perkslist[2]->ID);   
                      $html .= "</div>
                            </div>
                            <div class='pf-item-button'>
                                <button onclick=\"window.open('".$top3_item_meta['button_link'][0]."', '_blank')\" class='btn-pink btn-rd'>".$top3_item_meta['button_text'][0]."</button>
                            </div>
                        </div>
                    </div>
                </div>";
    }
          $html .= "</div>";

          $html .= "<div class='img-right'>";
                        if ($editor_image_2) {
                            $html .= "<img class='top-right' src='".$editor_image_2."'>";
                        } else {
                            $html .= "<img class='top-right' src=''>";
                        }
    
    if (isset($current_perkslist[1])) { 
        $top2_item_meta = get_post_meta($current_perkslist[1]->ID);

        $html .= "<div class='top-item'>
                    <input type='hidden' id='h_top_".$current_perkslist[1]->ID."' class='prod' value='".$current_perkslist[1]->ID."' />
                    <input type='hidden' id='h_top_".$category_id."' class='cat' value='".$category_id."' />
                    <div class='pf-item-image'>
                        <img src='".get_the_post_thumbnail_url($current_perkslist[1])."'>
                    </div>
                    <div class='pf-item-detail-container'>
                        <div class='pf-item-detail'>
                            <div class='pf-item-text'>
                                <div class='item-title'><b>".$top2_item_meta['perk_name'][0]."</b></div>
                                <div class='item-desc'>";
                                    $html .= $top2_item_meta['perk_detail'][0]; 
                      $html .= "</div>
                                <div class='item-price'>";
                                    $html .= $top2_item_meta['currency_symbol'][0].$top2_item_meta['price'][0]."/".get_field('price_type', $current_perkslist[1]->ID);   
                      $html .= "</div>
                            </div>
                            <div class='pf-item-button'>
                                <button onclick=\"window.open('".$top2_item_meta['button_link'][0]."', '_blank')\" class='btn-pink btn-rd'>".$top2_item_meta['button_text'][0]."</button>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    if (isset($current_perkslist[3])) { 
        $top4_item_meta = get_post_meta($current_perkslist[3]->ID);
            
        $html .= "<div class='top-item'>
                    <input type='hidden' id='h_top_".$current_perkslist[3]->ID."' class='prod' value='".$current_perkslist[3]->ID."' />
                    <input type='hidden' id='h_top_".$category_id."' class='cat' value='".$category_id."' />
                    <div class='pf-item-image'>
                        <img src='".get_the_post_thumbnail_url($current_perkslist[3])."'>
                    </div>
                    <div class='pf-item-detail-container'>
                        <div class='pf-item-detail'>
                            <div class='pf-item-text'>
                                <div class='item-title'><b>".$top4_item_meta['perk_name'][0]."</b></div>
                                <div class='item-desc'>";
                                    $html .= $top4_item_meta['perk_detail'][0]; 
                    $html .= "</div>
                                <div class='item-price'>";
                                    $html .= $top4_item_meta['currency_symbol'][0].$top4_item_meta['price'][0]."/".get_field('price_type', $current_perkslist[3]->ID);   
                    $html .= "</div>
                            </div>
                            <div class='pf-item-button'>
                                <button onclick=\"window.open('".$top4_item_meta['button_link'][0]."', '_blank')\" class='btn-pink btn-rd'>".$top4_item_meta['button_text'][0]."</button>
                            </div>
                        </div>
                    </div>
                </div>";
    }
            
          $html .= "</div>
                </div>
                <hr/>
                <div class='item-list-container'>
                    <div id='perkstore_left' class='arrow'>
                        <img src='".get_template_directory_uri()."/img/ico/ico-webarrow-left.png'>
                    </div>
                    <div class='item-content'>
                        <div class='row'>";
            
    foreach($current_perkslist as $i => $item) {
        $item_thumb_url = get_the_post_thumbnail_url($item);
        $item_meta = get_post_meta($item->ID);
        if ($i % 3 == 0) {

                  $html .= "<div class='item'>
                                <input type='hidden' id='h_".$item->ID."' class='prod' value='".$item->ID."' />
                                <input type='hidden' id='h_".$category_id."' class='cat' value='".$category_id."' />
                                <div class='pf-item-image'>
                                    <img src='".$item_thumb_url."'>
                                </div>
                                <div class='pf-item-detail-container'>
                                    <div class='pf-item-detail'>
                                        <div class='pf-item-text'>
                                            <div class='item-title'><b>".$item_meta['perk_name'][0]."</b></div>
                                            <div class='item-desc'>".$item_meta['perk_detail'][0]."</div>
                                            <div class='item-price'>".$item_meta['currency_symbol'][0].$item_meta['price'][0]."/".get_field('price_type', $item->ID)."</div>
                                        </div>
                                        <div class='pf-item-button'>
                                            <button onclick=\"window.open('".$item_meta['button_link'][0]."', '_blank')\" class='btn-pink btn-rd'>".$item_meta['button_text'][0]."</button>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            </div>";
        }
    }
    
              $html .= "</div>
                        <div class='row'>";
    foreach($current_perkslist as $i => $item) {
        $item_thumb_url = get_the_post_thumbnail_url($item);
        $item_meta = get_post_meta($item->ID);
        if ($i % 3 == 1) {

                    $html .= "<div class='item'>
                                <input type='hidden' id='h_".$item->ID."' class='prod' value='".$item->ID."' />
                                <input type='hidden' id='h_".$category_id."' class='cat' value='".$category_id."' />
                                <div class='pf-item-image'>
                                    <img src='".$item_thumb_url."'>
                                </div>
                                <div class='pf-item-detail-container'>
                                    <div class='pf-item-detail'>
                                        <div class='pf-item-text'>
                                            <div class='item-title'><b>".$item_meta['perk_name'][0]."</b></div>
                                            <div class='item-desc'>".$item_meta['perk_detail'][0]."</div>
                                            <div class='item-price'>".$item_meta['currency_symbol'][0].$item_meta['price'][0]."/".get_field('price_type', $item->ID)."</div>
                                        </div>
                                        <div class='pf-item-button'>
                                            <button onclick=\"window.open('".$item_meta['button_link'][0]."', '_blank')\" class='btn-pink btn-rd'>".$item_meta['button_text'][0]."</button>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            </div>
                            ";
        }
    }        
              $html .= "<div class='item'>
                        </div></div>
                        <div class='row'>";
    
    foreach($current_perkslist as $i => $item) {
        $item_thumb_url = get_the_post_thumbnail_url($item);
        $item_meta = get_post_meta($item->ID);
        if ($i % 3 == 2) {

                    $html .= "<div class='item'>
                                <input type='hidden' id='h_".$item->ID."' class='prod' value='".$item->ID."' />
                                <input type='hidden' id='h_".$category_id."' class='cat' value='".$category_id."' />
                                <div class='pf-item-image'>
                                    <img src='".$item_thumb_url."'>
                                </div>
                                <div class='pf-item-detail-container'>
                                    <div class='pf-item-detail'>
                                        <div class='pf-item-text'>
                                            <div class='item-title'><b>".$item_meta['perk_name'][0]."</b></div>
                                            <div class='item-desc'>".$item_meta['perk_detail'][0]."</div>
                                            <div class='item-price'>".$item_meta['currency_symbol'][0].$item_meta['price'][0]."/".get_field('price_type', $item->ID)."</div>
                                        </div>
                                        <div class='pf-item-button'>
                                            <button onclick=\"window.open('".$item_meta['button_link'][0]."', '_blank')\" class='btn-pink btn-rd'>".$item_meta['button_text'][0]."</button>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            </div>
                            ";
        }
    }
            
              $html .= "<div class='item'>
              </div>
              <div class='item'>
              </div></div>
                    </div>
                    <div id='perkstore_right' class='arrow'>
                        <img src='".get_template_directory_uri()."/img/ico/ico-webarrow-right.png'>
                    </div>
                </div>
            </div>
            <div class='item-detail-content-container hidden'>
                <div class='item-detail'>
                    <div class='item-detail-image'>
                        <img src=''>
                    </div>
                    <div class='item-detail-text'>
                        <div class='pf-item-text'>
                            <div class='item-title'><b></b></div>
                            <div class='item-desc'></div>
                            <div class='item-provide'><a href='' target='_blank'>Provider Website</a></div>
                        </div>
                        <div class='pf-item-button'>
                            <button class='btn-pink btn-rd'></button>
                            <div class='item-price'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='item-cosmetic-image-container'>
                    <div id='item_left' class='arrow'>
                        <img src='".get_template_directory_uri()."/img/ico/ico-webarrow-left.png'>
                    </div>
                    <div class='item-image-content'>
                        <div class='image-list'>
                            <div class='image-item'>
                                <img id='item1' src=''>
                            </div>
                            <div class='image-item'>
                                <img id='item2' src=''>
                            </div>
                            <div class='image-item'>
                                <img id='item3' src=''>
                            </div>
                        </div>
                    </div>
                    <div id='item_right' class='arrow'>
                        <img src='".get_template_directory_uri()."/img/ico/ico-webarrow-right.png'>
                    </div>
                </div>
                <hr/>
                <div class='item-support-device'>
                    <div class='left'>
                        <b>Supported Devices:</b>
                    </div>
                    <div class='right'>
                        <a href='' class='item-link' target='_blank'>
                        Show All
                        </a>
                    </div>
                </div>
                <hr/>
                <div class='item-helpful-link'>
                    <div class='item-title'>
                        <b>Helpful Information</b>
                    </div>
                    <div class='item-link'>
                        <a href='' id='helpful1' target='_blank'></a>
                    </div>
                    <div class='item-link'>
                        <a href='' id='helpful2' target='_blank'></a>
                    </div>
                </div>
            </div>
            <div class='item-search-content-container hidden'>
            Search Results
            </div>";

    $html .= "<script type='text/javascript' src='".get_stylesheet_directory_uri()."/js/mysite.js'></script>";
    $response = new WP_REST_Response($html);
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

function send_email_without_request($emailFrom, $nameFrom, $emailTo, $nameTo, $emailSubject, $textBody=null) {
    
    // $to_email = $request['email'];
    // $subject = "Simple Email Test via PHP";
    // $body = "Hi,nn This is test email send by PHP Script";
    // $headers = "From: sender\'s email";
    

    // if (mail($to_email, $subject, $body, $headers)) {
    //     echo "Email successfully sent to $to_email...";exit();
    // } else {
    //     echo "Email sending failed...";exit();
    // }

    // sendgrid
    include_once( ABSPATH.'wp-content/sendgrid-php/sendgrid-php.php');

    $API_KEY_SENDGRID = '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';

    $templateId = "d-f66183a7168b4df7b9e188f760d66e43";

    // $emailHtml = file_get_contents("sendmail.html");
    
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom($emailFrom, $nameFrom);
    $email->setSubject($emailSubject);
    $email->addTo($emailTo, $nameTo);
    // $email->addContent("text/html", $emailHtml);
    if ($textBody == null) {
        $email->setTemplateId($templateId);
        $email->addSubstitution("firstname", $nameTo);
        $email->addSubstitution("youremail", $emailTo);
        $email->addSubstitution("linkurl", "http://perkfix.com/thanks/");
        $email->addSubstitution("inserthyperlink", 'http://perkfix.com');
        $email->addSubstitution("bookcall", "https://calendly.com/aj-perkfix");
    }
    else {
        $email->addContent("text/html", $textBody);
    }
    
    $sendgrid = new \SendGrid($API_KEY_SENDGRID);
    
    try {
        $response = $sendgrid->send($email);
        // print $response->statusCode() . "\n";
        // print_r($response->headers());
        // print $response->body() . "\n";
    } catch (Exception $e) {
        // echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    // die();

}

function send_email($request) {

    $emailFrom = "aj@perkfix.com";
    $nameFrom = "A J";

    $emailTo = $request['email'];
    $nameTo = $request['firstname'] . " " . $request['lastname'];

    $emailSubject = "Verify From perkfix.com";

    send_email_without_request($emailFrom, $nameFrom, $emailTo, $nameTo, $emailSubject);

    $url = get_site_url() . '/authentication/?email='.$request['email'].'&firstname='.$request['firstname'].'&lastname='.$request['lastname'];
    wp_redirect($url, 301);
    exit();
}

function post_get_started($request) {

    $userdata = array(
        'user_pass' => 'test1234',
        'user_login' => $request['email'], 
        'user_email' => $request['email'],
        'first_name' => $request['firstname'],
        'last_name' => $request['lastname'],
        'show_admin_bar_front' => false,
        'role' => 'hr_trial'
    );

    $user_id = wp_insert_user($userdata);

    $ret = array();
    // On success
    if (!is_wp_error($user_id)) {
        send_email($request);
    } else {
        $url = get_site_url() . '/get-started/?error=wrong';
        // print_r($user_id); exit();
        wp_redirect($url, 301);
    }
    exit();
}

function post_contact_us($request) {

    $emailFrom = "aj@perkfix.com";
    $nameFrom = "A J";

    $emailTo = "aj@perkfix.com";
    $nameTo = "A J";

    $emailSubject = "Contact From perkfix.com";

    // Set request body.
    $message  = "<html>";
    $message .=   "<body>";
    $message .=     "<p><b>From:</b><br>" . $request['firstname'] . " " . $request['lastname'] . "</p>";
    $message .=     "<p><b>Email:</b><br>" . $request['email'] . "</p>";
    $message .=     "<p><b>Contact Number:</b><br>" . $request['contact_number'] . "</p>";
    $message .=     "<p><b>Subject:</b><br>" . $request['subject'] . "</p>";
    $message .=     "<p><b>Message:</b><br>" . $request['message'] . "</p>";
    $message .=   "</body>";
    $message .= "</html>";

    send_email_without_request($emailFrom, $nameFrom, $emailTo, $nameTo, $emailSubject, $message);

    $url = get_site_url();
    wp_redirect($url, 301);
    exit();
}

function mysite_js() {
    wp_enqueue_script('autocomplete', get_stylesheet_directory_uri().'/js/jquery.auto-complete.js', array('jquery'));
    //wp_enqueue_script('mysite-js', get_stylesheet_directory_uri().'/js/mysite.js', array('jquery', 'autocomplete'));
    wp_enqueue_style('autocomplete.css', get_stylesheet_directory_uri().'/js/jquery.auto-complete.css');
}

add_action('wp_enqueue_scripts', 'mysite_js');

add_action('wp_ajax_nopriv_get_perkfix_names', 'ajax_listings');
add_action('wp_ajax_get_perkfix_names', 'ajax_listings');

function ajax_listings() {
    global $wpdb;

    $name = $wpdb->esc_like(stripslashes($_POST['k']));
    
    $tag_query = array( 'tag' => $name, 'post_type' => 'perks' );
    $posts_array = get_posts( $tag_query );
    $titles = array();
    foreach ($posts_array as $item) {
        $titles[] = $item->post_title;
    }

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