<?php
 header('Content-Type: application/json; charset=utf-8');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

// route:
// https://your-app-backend-hostname.your-domain.com/your-app-backend-path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('botdetect-captcha-lib/simple-botdetect.php');

    $postedData = (array) json_decode(file_get_contents('php://input'), true);

    $userEnteredCaptchaCode = $postedData['userEnteredCaptchaCode'];
    $captchaId = $postedData['captchaId'];

    // create a captcha instance to be used for the captcha validation
    $yourFirstCaptcha = new SimpleCaptcha();
    // execute the captcha validation
    $isHuman = $yourFirstCaptcha->Validate($userEnteredCaptchaCode, $captchaId);

    if ($isHuman == false) {
        // captcha validation failed; notify the frontend 
        // TODO: consider logging the attempt
        echo "{\"success\":false}";
    } else {
        // TODO: captcha validation succeeded; execute the protected action
        // TODO: do not forget to notify the frontend about the results
        echo "{\"success\":true}";
    }
}
?>