<?php
// Template name: Login Page
?>
    <!-- <div class="login">
        <div class="login-page">
            <div class="form">
                <form class="login-form">
                  <h1>Log in to your <br/>Admin account</h1>
                  <input type="text" placeholder="Username (corperate email)"/>
                  <input type="password" placeholder="Password"/>
                  <button>Login</button>
                  <p class="message">Don't have an account?<br/> <a href="<?php echo home_url('/trial');?>">Sign up here</a></p>
                </form>
            </div>
        </div>
    </div> -->
    <div class="login">
        <div class="login-page">
            <h1>Hello</h1>
            <div class="btn-group">
                <button class="btn btn-employers" onclick="location.href='./get-started';">HR/Employers</button>
                <button class="btn btn-employees" onclick="location.href='./authentication';">Employees</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $(".header").css("background-color", "rgba(33, 33, 33, 1)");
    });
    </script>
