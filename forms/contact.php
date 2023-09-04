<?php
  // Simple form validation: check if all required fields are present
  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    
    // Sanitize the input to avoid XSS and other potential issues
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    // Set up receiving email address (replace this with your own)
    $to = 'jordancastlingbolt@gmail.com';
    $headers = "From: {$email}\r\n" .
               "Reply-To: {$email}\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Send the email
    $result = mail($to, $subject, $message, $headers);
    
    if ($result) {
      echo "Your message has been sent. Thank you!";
    } else {
      echo "Failed to send message.";
    }
  } else {
    echo "Please fill in all required fields.";
  }
?>
