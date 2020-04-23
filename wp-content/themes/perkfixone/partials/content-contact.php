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
                    <button class="button-cancel">Cancel</button>
                    <button type="submit" class="button-send">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
