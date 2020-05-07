<?php
// Template name: Login Page
?>
    <div class="login">
        <div class="login-page">
            <div class="form">
                <form class="login-form" method="POST" action="<?php echo site_url().'/wp-json/perkstore/v1/log_in/'; ?>">
                  <h1>Log in to your <br/>Admin account</h1>
                  <input type="text" name="login_email" placeholder="Username (corperate email)" />
                  <input type="password" name="login_pass" placeholder="Password" />
                  <button type="submit">Login</button>
                  <p class="message">Don't have an account?<br/> <a href="<?php echo home_url('/trial');?>">Sign up here</a></p>
                </form>
            </div>
        </div>
    </div>
    
