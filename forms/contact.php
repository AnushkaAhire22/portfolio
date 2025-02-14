<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "your_email@example.com"; // Replace with your email address
    $from_name = htmlspecialchars($_POST['name']);
    $from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Construct the email body
    $email_body = "Name: $from_name\n";
    $email_body .= "Email: $from_email\n";
    if (!empty($_POST['phone'])) {
        $phone = htmlspecialchars($_POST['phone']);
        $email_body .= "Phone: $phone\n";
    }
    $email_body .= "Message:\n$message\n";
    
    // Send the email
    if (mail($to, $subject, $email_body, $headers)) {
        echo "success"; // Response for AJAX
    } else {
        echo "error"; // Response for AJAX
    }
} else {
    echo "Invalid request!";
}
?>
