<?php

/**
 *  THIS CLASS IS USED TO SEND CV TO ENTREPRISE AND
 * MAKE JUST CAMPAGNING
 */
require '../../vendor/autoload.php';



// Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer();

// Set the mail server details (you may need to adjust these)
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'eabizimi@gmail.com';
$mail->Password = 'Emanuel2020abi   ';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Set the sender and recipient email addresses
$mail->setFrom('eabizimi@gmail.com', 'Sender Name');
$mail->addAddress('contact@sitefix.fr', 'Recipient Name');

// Set the email subject and message
$mail->Subject = 'Test Email with Attachment';
$mail->Body = 'Hello, this is a test email with an attachment.';

// Add an attachment
//$fileAttachment = '/path/to/your/file.txt';
//$mail->addAttachment($fileAttachment);

// Check if the email was sent successfully
if ($mail->send()) {
    echo 'Email sent successfully.';
} else {
    echo 'Failed to send email. Error: ' . $mail->ErrorInfo;
}

