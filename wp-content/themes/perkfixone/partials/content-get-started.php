<?php
// Template name: Get Started Page
?>
    <div class="get-started">
        <div class="get-started-page">
            <div class="title">
                <h1>Let's Get Started</h1>
                <p>We need some details from you</p>
            </div>
            <div <?php echo (isset($_REQUEST['error']) && $_REQUEST['error'] == "wrong")?"":"hidden"; ?> >
                <h3 style="color: #FF6666; border: 1px solid #FF6666;">An account with this email already exists, please login to the system.</h3>
            </div>
            <form id="get_started" method="POST" action="<?php echo site_url().'/wp-json/perkstore/v1/get_started/'; ?>">
                <div class="content">
                    <h4>Legal Entity Name <span class="red">*</span></h4>
                    <input type="text" name="comapnyname" placeholder="ACME INC" required>
                    <h4>Your Name <span class="red">*</span></h4>
                    <input type="text" name="firstname" class="part-name float-left" placeholder="John" required>
                    <input type="text" name="lastname" class="part-name float-right" placeholder="Doe" required>
                    <div class="clearfix"></div>
                    <h4>Your Corporate Email <span class="red">*</span></h4>
                    <input type="email" name="email" placeholder="jdoe@acme.com" required>
                    <div></div>
                    <p><input type="checkbox" name="accept" required>&nbsp;I accept terms and conditions. <span class="red">*</span></p>
                    <a href="<?php echo home_url('/trial');?>" class="float-left">&lt;Previous</a>
                    <a href=".">Save for later</a>
                    <button type="submit" class="submit-btn float-right">Next&gt;</button>
                </div>
            </form> 
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $(".header").css("background-color", "rgba(33, 33, 33, 1)");
    });
    </script>
