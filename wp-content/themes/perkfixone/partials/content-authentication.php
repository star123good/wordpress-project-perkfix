<?php
// Template name: Authentication Page
?>
    <div class="auth">
        <div class="auth-page">
            <!-- <h1>Authentication</h1> -->
            <h1>Check Email</h1>
            <div class="content">
                <p>We have sent you an authentication link to your corporate email.</p>
                <!-- <p>Please type the code here.</p> -->
                <a href="<?php echo site_url().'/wp-json/perkstore/v1/send_email/?email='.(isset($_REQUEST['email'])?$_REQUEST['email']:"").'&firstname='.(isset($_REQUEST['firstname'])?$_REQUEST['firstname']:"").'&lastname='.(isset($_REQUEST['lastname'])?$_REQUEST['lastname']:"").''; ?>">Resend email</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $(".header").css("background-color", "rgba(33, 33, 33, 1)");
    });
    </script>
