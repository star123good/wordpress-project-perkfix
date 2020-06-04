
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">-->
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

        <style>

            .hide {
                display : none !important;
            }
            .show {
                display : flex !important;
            }
            body .header, .custom-header {
                width: 100%;
                background-color: #000000;
                color: white;
                display: flex;
                justify-content: space-evenly;
                align-items: center;
                font-size: 1.25rem;
                font-family: SFProText-Medium;
                }
                #custom-header-navbar {
                min-height: 68px;
                }
                .custom-header .navbar-collapse, .custom-header .dropdown-menu {
                background-color: #000000;
                border-width: 0px;
                font-size: 100%;
                z-index: 10001;
                }
                .custom-header .dropdown-item {
                color: #fff;
                }
                .custom-header-subnav {
                background-color: #656565;
                display: none;
                }
                .custom-header-subnav.show {
                height: 50px;
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
                }
                .custom-header-subnav.hide {
                height: 0px;
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
                }
                .custom-header-subnav a {
                color: #fff;
                font-family: SFProText-Light !important;
                text-align: right;
                letter-spacing: 1px;
                }
                .custom-header button.navbar-toggler {
                border-width: 0px;
                }
                .custom-header button.navbar-toggler:not(.collapsed) span.navbar-toggler-icon {
                background: none;
                text-indent: 0%;
                }
                .custom-header button.navbar-toggler span.navbar-toggler-icon {
                font-size: 1.5em;
                line-height: 1.5;
                color: #fff;
                border-width: 0px;
                overflow: hidden;
                text-indent: 100%;
                }
                .custom-header-subnav a:hover {
                font-family: SFProText-Bold !important;
                letter-spacing: 0.3px;
                }
                .trial-nav-btn {
                background-color: #29c888;
                font-size: 11px;
                line-height: 16px;
                padding: 3px 10px 3px 10px !important;
                right: 0px;
                }
                @media (max-width: 1200px) {
                .hide-mobile-subnav {
                    display: none;
                }
                .show-mobile-subnav {
                    display: list-item;
                }
                .show-mobile-subnav-link {
                    display: inline-block;
                }
                }
                @media (min-width: 1200px) {
                .navbar-expand-xl.custom-header .navbar-nav .dropdown-menu {
                    display: none;
                }
                .custom-header-subnav {
                    display: flex;
                    justify-content: start;
                }
                .show-mobile-subnav, .show-mobile-subnav-link {
                    display: none;
                }
                .perkfix-home7 .content-icon1 .col-auto {
                    padding-left: 60px;
                }
                .perkfix-home7 .content-icon1 .col {
                    padding-left: 80px;
                }
                }

        </style>

        <div class="header">
            <a href="<?php echo home_url('/');?>"><img src="<?php bloginfo('template_url'); ?>/img/perkfix-green-logo-pf.png" class="logo mobile-logo"></a>
            <a id="pg_perkstore" class="pg-menu" href="#" data-id="nav-custom-dropdown">Products</a>
            <a id="pg_platform" class="pg-menu" href="/pricing">Pricing</a>
            <a id="pg_trial" href="/trial" class="btn btn-green">Start trial</a>
            <a id="pg_login" class="pg-menu mobile-login" href="/login">Log In</a>
        </div>
        <div class="custom-header custom-header-subnav hide">
            <a href="/platform" style="margin-left: 37%; text-decoration: none;">Platform</a>
            <a href="/shop-perks" style="margin-left: 8%; text-decoration: none;">Shop Perks</a>
        </div>

        <script>
            $(document).ready(function() {
                $("[data-id='nav-custom-dropdown']").click(function(event) {
                    event.preventDefault();
                    if ($(".custom-header-subnav").hasClass('show')) {
                        $(".custom-header-subnav").removeClass('show');
                        $(".custom-header-subnav").addClass('hide');
                    } 
                    else{
                        $(".custom-header-subnav").removeClass('hide');
                        $(".custom-header-subnav").addClass('show');
                    }
                });
            });
        </script>

        <div class="pfo-container">
