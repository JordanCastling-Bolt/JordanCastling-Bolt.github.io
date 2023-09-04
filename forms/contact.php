<?php
$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($data['name']) && isset($data['email']) && isset($data['subject']) && isset($data['message'])) {
    
    $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($data['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($data['message'], FILTER_SANITIZE_STRING);

    $to = 'jordancastlingbolt@gmail.com';
    $headers = "From: {$email}\r\n" .
               "Reply-To: {$email}\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
      echo json_encode(['status' => 'success']);
    } else {
      echo json_encode(['status' => 'fail']);
    }
  } else {
    echo json_encode(['status' => 'error']);
  }
}
