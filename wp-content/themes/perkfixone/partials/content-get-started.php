<?php
// Template name: Get Started Page
?>
    <div class="get-started">
        <div class="get-started-page">
            <div class="title">
                <h1>Let's Get Started</h1>
                <p>We need some details from you</p>
            </div>
            <div class="content">
                <h4>Legal Entity Name <span class="red">*</span></h4>
                <input type="text" name="fullname" placeholder="ACME INC">
                <h4>Your Name <span class="red">*</span></h4>
                <input type="text" name="firstname" class="part-name float-left" placeholder="John">
                <input type="text" name="lastname" class="part-name float-right" placeholder="Doe">
                <div class="clearfix"></div>
                <h4>Your Corporate Email <span class="red">*</span></h4>
                <input type="text" name="email" placeholder="jdoe@acme.com">
                <div></div>
                <p><input type="checkbox" name="accept">&nbsp;I accept terms and conditions. <span class="red">*</span></p>
                <a href="." class="float-left">&lt;Previous</a>
                <a href=".">Save for later</a>
                <a href="." class="float-right">Next&gt;</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $(".header").css("background-color", "rgba(33, 33, 33, 1)");
    });
    </script>
