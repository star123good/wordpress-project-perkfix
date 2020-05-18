<?php
// Template name: Thanksforsignup Page
?>
    <div class="auth content-thanks" style="background-color: white; height:auto !important;">
        <div class="auth-page" style="padding-top: 80px !important;">
            <h1 style="color: black;">Thanks for Signing up</h1>
            <div class="content">
                <p style="color: black;">One of our perk specialists will get in touch with you.</p>
                <p style="color: black;">Let's setup a quick call to understand you needs.</p>

                <!-- Calendly inline widget begin -->
                <div class="calendly-inline-widget" data-url="https://calendly.com/steven-249/perkfix" style="min-width:320px;height:650px;"></div>
                <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
                <!-- Calendly inline widget end -->

                <a href="https://calendly.com/event_types/user/me">Book Call</a>
                OR

            </div>
            <div class="content" style="display: flex; justify-content: center;">
                <div class="input-content">
                    <img class="flag" src="<?php bloginfo('template_url'); ?>/img/img-flag-us.png" width="36px">
                    <span style="color: black;">+1</span>
                    <input type="text" placeholder="Enter phone number">
                    <img class="phone" src="<?php bloginfo('template_url'); ?>/img/ico/ico-phone.png">
                </div>
                
            </div>
            <div class="call-content" style="display: flex; justify-content: space-around; margin-bottom: 50px;">
                <a class="call" href="home_url();" style="color: white; background-color: gray;">Cancel</a>
                <a class="call" href="tel:19294005667" style="color: white;">Call Me Now</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $(".header").css("background-color", "rgba(33, 33, 33, 1)");
    });
    </script>
