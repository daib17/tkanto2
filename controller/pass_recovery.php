<?php
require_once("src/admin_functions.php");
require_once("phpmailer/src/PHPMailer.php");
require_once("phpmailer/src/SMTP.php");
require_once("phpmailer/src/Exception.php");
require_once("phpmailer/src/OAuth.php");
require_once("phpmailer/src/POP3.php");

$email = $emailError = "";

$button = getPost("button");

if ($button == "send") {
    $isValid = true;
    // Sanitize email
    $email = clean(getPost("email"));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
        $isValid = false;
    }

    // Check email in database
    if ($isValid) {
        $sql = "SELECT * FROM student WHERE email = ?;";
        $res = $db->executeFetch($sql, [$email]);
        if (!$res) {
            $isValid = false;
        } else {
            // Reset password
            $newPass = resetStudentPassword($db, $email);
            // Send email
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            // $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->Username = 'tecnikanto@gmail.com';
            $mail->Password = 'Baba1974';
            $mail->SetFrom('tecnikanto@gmail.com', 'TecniKanto');
            $mail->AddAddress($email); // To
            // Carbon copy (cc)/ blind carbon copy (bcc)
            // $mail->AddCC('user1@domain.com');
            $mail->Subject = "Password reset";
            // Message
            $message = "<p>Your password has been reset.</p>";
            $message .= "<p>New password: <b>{$newPass}</b></p>";
            $message .= "<p>Remember that you can change your password accessing your account details at TecniKantos website.</p>";
            $mail->IsHTML (true);
            $mail->MsgHTML($message);

            // Send
            try {
                $mail->send();
            } catch (phpmailerException $e) {
                // echo $e->getMessage();
            } catch (Exception $e) {
                // echo $e->getMessage();
            }
        }
    }
} else {
    $isValid = false;
}
