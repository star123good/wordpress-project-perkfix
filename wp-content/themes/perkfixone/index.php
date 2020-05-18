<?php global $wp; ?>
<?php 
if ($wp->request == '') {
    get_header('home'); 
} else {
    get_header();
}
?>
<?php
    global $wp;
    //print_r($wp);
    
    get_template_part('partials/content', $wp->request);
    /*$uri = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "/", 1));
    //echo $uri;
    $current_url = str_replace('/', '', $uri);
    $urls = array("", "perkstore", "platform", "login", "trial", "terms");
    
    if (in_array($current_url, $urls)) {
        get_template_part( 'partials/content', $current_url );
    } else {
        echo 'error';
	get_template_part( 'partials/content', 'error' );
    }*/
?>
<?php get_footer(); ?>
