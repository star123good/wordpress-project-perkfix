<!-- <?php
// Template name: Trial Page
?>
    <div class="login">
        <div class="login-page">
            <div class="form">
                <form class="register-form">
                <h1>Get Early<br/>access.</h1>
                <input type="text" placeholder="Company Name *"/>
                <input type="text" placeholder="Your Corperate Email *"/>
                <button>Submit</button>
                <a class="btn-social"><img src="<?php bloginfo('template_url'); ?>/img/btn-linkedin.png"></a>
                <p class="message">Already registered? <a href="<?php echo home_url('/log-in');?>">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(function() {
        $(".header").css("background-color", "rgba(33, 33, 33, 1)");
    });
    $(".btn-social").on('mousedown', function() {
        $(this).html("<img src='<?php bloginfo('template_url'); ?>/img/btn-linkedin-on.png'>");
    });
    $(".btn-social").on('mouseup', function() {
        $(this).html("<img src='<?php bloginfo('template_url'); ?>/img/btn-linkedin.png'>");
    });
    </script> -->

    <div class="trial">
        <div class="login-page">
            <h1>Hello</h1>
            <div class="btn-group">
                <button class="btn btn-employers" onclick="location.href='./get-started';">HR/Employers</button>
                <!-- <button class="btn btn-employees" onclick="location.href='./authentication';">Employees</button> -->
                <button class="btn btn-employees" onclick="">Employees</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $(".header").css("background-color", "rgba(33, 33, 33, 1)");
    });
    </script>