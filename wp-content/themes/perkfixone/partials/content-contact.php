<?php 
 // Template name : Contact Page
?>
<div class="contact-content">
    <div>
        <p class="top-part">Perkfix support options are currently limited. Thank you for your patience.</p>
    </div>
    <div>
        <h1>Contact us</h1>
        <p>We can be reached via this form.</p>
    </div>
    <hr>
    <div>
        <form action="<?php echo site_url().'/wp-json/perkstore/v1/contact_us/'; ?>" method="POST">
            <div class="content">
                <div>
                    <label for="">Name<span class="red">*</span></label>
                    <input type="text" placeholder="First Name" class="col-one" name="firstname" required>
                    <input type="text" placeholder="Last Name" class="col-one" name="lastname" required>
                </div>
                <div>
                    <label for="">Contact Number</label>
                    <input type="text" placeholder="(xxx) xxx xxxx" class="col-two" name="contact_number">
                </div>
                <div>
                    <label for="">Your Email<span class="red">*</span></label>
                    <input type="text"  class="col-two" name="email" required>
                </div>
                <div>
                    <label for="">Subject<span class="red">*</span></label>
                    <input type="text"  class="col-two" name="subject" required>
                </div>
                <div>
                    <label for="">Message<span class="red">*</span></label>
                    <textarea cols="30" rows="10" name="message" required></textarea>
                </div>
                <div style="text-align: right;">
                    <button class="button-cancel myButton">Cancel</button>
                    <button type="submit" class="button-send myButton">Send</button>
                </div>
            </div>
        </form>
    </div>
    <div style="margin-top: 55px;">
        <h1>Need help sooner?</h1>
        <p>Or you can book a call with one of our perk specialists.</p>
    </div>
    <hr>
</div>
<div>
    <!-- Calendly inline widget begin -->
    <div class="calendly-inline-widget" data-url="https://calendly.com/steven-249/perkfix" style="min-width:320px;height:650px;"></div>
    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
    <!-- Calendly inline widget end -->
</div>
<div class="contact-content content-thanks">
    <div style="display: flex; justify-content: space-around; margin-bottom: 20px;">
        <a href="https://calendly.com/event_types/user/me" style="color: rgba(0, 176, 255, 1); font-size: 1.3em;">Save & Exit</a>
        <a href="https://calendly.com/event_types/user/me" style="color: rgba(0, 176, 255, 1); font-size: 1.3em;">Book Call</a>
    </div>
    <div style="text-align: center;">
        <h3>OR</h3>
    </div>
    <div style="display: flex; justify-content: center;">
        <div class="input-content">
            <img class="flag" src="<?php bloginfo('template_url'); ?>/img/img-flag-us.png" width="36px">
            <span style="color: black;">+1</span>
            <input type="text" placeholder="Enter phone number">
            <img class="phone" src="<?php bloginfo('template_url'); ?>/img/ico/ico-phone.png">
        </div>
        
    </div>
    <div class="call-content" style="display: flex; justify-content: space-around; margin-bottom: 50px;">
        <a class="call" href="home_url();" style="color: white; background-color: gray; width: 120px;">Cancel</a>
        <a class="call" href="tel:19294005667" style="color: white;">Call Me Now</a>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $(".subfooter-title").html("");
        $(".subfooter-title").css('height', '120px');
    });
</script>
