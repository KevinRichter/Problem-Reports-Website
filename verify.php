<?php
  session_start();	
  require_once('recaptchalib.php');
  $privatekey = "6LcpK9oSAAAAAI_-W0ros2NywzMhL1xQFuOgvJWS";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
    // Your code here to handle a successful verification
    header("Location:save_report.php");
  }
  ?>