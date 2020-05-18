<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Perkfix.com</title>

        
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/style.css'; ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/js/jquery-3.4.1.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/js/jquery-ui.min.js'; ?>"></script>
        <?php wp_head(); ?>
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/perkfix-logo.png" />
    </head>

    <body>
        <div class="header">
            <a href="<?php echo home_url('/');?>"><img src="<?php bloginfo('template_url'); ?>/img/perkfix-green-logo-pf.png" class="logo mobile-logo"></a>
            <a id="pg_perkstore" class="pg-menu" href="<?php echo home_url('/perkstore');?>">Perk Store</a>
            <a id="pg_platform" class="pg-menu" href="<?php echo home_url('/platform');?>">Platform</a>
            <a id="pg_login" class="pg-menu mobile-login" href="<?php echo home_url('/log-in');?>">Log In</a>
            <a id="pg_trial" href="<?php echo home_url('/trial');?>" class="btn btn-green">Start trial</a>
        </div>
    <div class="pfo-container">
