<?php

$response = [];

function cleanInput($input) {
  return addslashes($input);
}

function validateEmail($email) {
  return (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) ? 1 : 0;
}

function validateEmpty($str) {
  return preg_match("/\S/", $str);
}

function add_error (&$response , $errprType) {
  $response["Error"] = true;
  if (!isset($response["ErrorType"])) {
    $response["ErrorType"] = [];
  }
  array_push ($response["ErrorType"], $errprType);
}

if (isset($_POST)) {
  $full_name      = cleanInput(@$_POST['full_name']);
  $email          = cleanInput(@$_POST['email']);
  $message        = cleanInput(@$_POST['message']);
  $messageAbout   = cleanInput(@$_POST['messageAbout']);
  $phone          = cleanInput(@$_POST['phone']);
  if (!validateEmail ($email)) {
    add_error($response, "emailValidation");
  }
  if (!validateEmpty ($full_name)) {
    add_error($response, "nameValidation");
  }
  if (!validateEmpty ($message)) {
    add_error($response, "messageValidation");
  }
  if (empty($response)) {
    $response ["Error"] = false;
    include 'sendEmail.class.php';
    $mailClass                = new sendEmail();
    $mailClass->sendFrom      = "Sakura - $messageAbout";
    $mailClass->subject       = "$messageAbout";
    $mailClass->Body          = "<div>" . $message . "<br> <b>From</b>: $full_name<br> <b>Email</b>: $email<br> <b>Phone Number</b>: $phone</div>";
    $mailClass->sendFromEmail = $email;
    if ($mailClass->send()) {
      $response ["Success"] = true;
    } else {
      $response ["Success"] = false;
    }
  }
}

echo json_encode ($response);
