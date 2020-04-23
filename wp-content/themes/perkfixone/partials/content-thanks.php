<?php
// Template name: Thanksforsignup Page
?>
<style>
    .input-content {
                display:flex;
                align-items: center;
                border-radius: 5px;
                margin: 4px;
                margin-top: 40px;
                margin-bottom: 30px;
                height: 60px;
                max-width: 374px;
                background-color: rgba(216, 216, 216, 0.32);
                border: 1px solid rgba(151, 151, 151, 1);
                justify-content: center;
            }
            .flag {
                margin: 7px;
            }
            .input-content span {
                margin: 2px;
                font-size: 1.5rem;
                font-weight: 500;
            }
            .input-content input {
                border: 1px solid transparent;
                font-size: 1.5rem;
                max-width: 255px;
                background:transparent;
            }
            .input-content input::placeholder {
                color: rgba(0, 0, 0, 0.5);
            }
            .input-content input:active {
                border: 1px solid transparent;
            }
            .input-content input:focus {
                border: 1px solid transparent;
                outline: none;
            }
            .call-content {
                margin: 4px;
            }
            .call {
                display:block;
                border-radius: 5px;
                margin-left: 8px;
                padding: 18px 10px;
                max-width: 158px;
                font-size: 1.5rem;
                color: white;
                background-color: rgba(0, 200, 136, 1);
                cursor: pointer;
            }
            .reference-content {
                margin-top: 24px;
            }
</style>
    <div class="auth" style="background-color: white; height:auto !important;">
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
            <div class="call-content" style="display: flex; justify-content: space-around;">
                <a class="call" href="home_url();" style="color: white; background-color: gray;">Cancel</a>
                <a class="call" style="color: white;">Call Me Now</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $(".header").css("background-color", "rgba(33, 33, 33, 1)");
    });
    </script>
