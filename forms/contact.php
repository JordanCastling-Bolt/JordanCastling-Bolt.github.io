<?php
// Set the response content type to JSON
header('Content-Type: application/json');

// Decode the JSON payload from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate the presence of required fields
  if (isset($data['name']) && isset($data['email']) && isset($data['subject']) && isset($data['message'])) {

    // Sanitize the input fields
    $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($data['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($data['message'], FILTER_SANITIZE_STRING);

    // Recipient email address
    $to = 'jordancastlingbolt@gmail.com';

    // Email headers
    $headers = "From: {$email}\r\n" .
               "Reply-To: {$email}\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
      echo json_encode(['status' => 'success']);
    } else {
      echo json_encode(['status' => 'fail']);
    }

  } else {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
