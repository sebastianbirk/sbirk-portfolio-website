<?php

  // trim() function strips any white space from beginning and end of the string
  $email = filter_var(trim($_POST["contactEmail"]), FILTER_SANITIZE_EMAIL);
  //  strip_tags() function strips all HTML and PHP tags from a variable.
  $message = strip_tags($_POST["contactMessage"]);

  $subject = strip_tags($_POST["contactSubject"]);

  // Check that data was sent to the mailer.
  if ( empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Set a 400 (bad request) response code and exit.
    http_response_code(400);
    echo "Oops! There was a problem with your submission. Please complete the form and try again.";
    exit;
  }

  // Set the recipient email address.
  $recipient = "sebastian.birk94@gmail.com";

  // success
  $success = mail($recipient, $subject, $message, "From:" . $email);

  // Send the email.
  if ($success) {
    // Set a 200 (okay) response code.
    http_response_code(200);
    echo "Thank You! Your message has been sent.";
  } else {
    // Set a 500 (internal server error) response code.
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn’t send your message.";
  }

?>