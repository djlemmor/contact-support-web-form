<?php
// Server-side validation and saving to database logic

// Retrieve form data
$fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Validate the data
$errors = array();

// Full Name validation
if (empty($fullname)) {
    $errors[] = "Full Name is required.";
} elseif (!preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
    $errors[] = "Full Name should only contain letters and spaces.";
}

// Email validation
if (!$email) {
    $errors[] = "Invalid Email Address.";
}

// Mobile Number validation
if (empty($mobile)) {
    $errors[] = "Mobile Number is required.";
} elseif (!preg_match('/^[0-9+\s]+$/', $mobile)) {
    $errors[] = "Mobile Number should only contain numbers and spaces.";
}

// Subject validation
if (empty($subject)) {
    $errors[] = "Subject is required.";
} elseif (strlen($subject) > 100) {
    $errors[] = "Subject should not exceed 100 characters.";
}

// Body validation
if (empty($body)) {
    $errors[] = "Body is required.";
}

// Check if there are any validation errors
if (!empty($errors)) {
    // Store the error messages in the session
    session_start();
    $_SESSION['errors'] = $errors;
    
    // Redirect back to the contact form page
    header('Location: ../index.php');
    exit;
}

// Verify reCAPTCHA
$recaptcha_secret = "6LfYmAMmAAAAANMyQldH_-m97KZhc0vzSPVdtxBz";
$recaptcha_response = $_POST['g-recaptcha-response'];
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_data = array(
  'secret' => $recaptcha_secret,
  'response' => $recaptcha_response
);

$options = array(
  'http' => array(
    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
    'method' => 'POST',
    'content' => http_build_query($recaptcha_data)
  )
);

$recaptcha_context = stream_context_create($options);
$recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
$recaptcha_json = json_decode($recaptcha_result);

if (!$recaptcha_json->success) {
  die("reCAPTCHA verification failed");
}


// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact-support-web-form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$sql = "INSERT INTO tickets (fullname, email, mobile, subject, body) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind the form inputs to the prepared statement
$stmt->bind_param("sssss", $fullname, $email, $mobile, $subject, $body);

// Execute the prepared statement
if ($stmt->execute()) {
  // Redirect back to the contact form with a success message
  header("Location: ../index.php?message=success");
} else {
  // Redirect back to the contact form with a error message
  header("Location: ../index.php?message=error");
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();

// Send the ticket to the admin email address
$to = 'progtest@thriivetank.com';
$subject = $subject;
$message = "A new support ticket has been submitted:\n\nFull Name: $fullname\nEmail: $email\nMobile: $mobile\nSubject: $subject\n\n$body";
$headers = "From: $email";

mail($to, $subject, $message, $headers);
  exit();
?>
