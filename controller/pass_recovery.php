<?php
require_once("src/admin_functions.php");
require_once("phpmailer/src/PHPMailer.php");
require_once("phpmailer/src/SMTP.php");
require_once("phpmailer/src/Exception.php");
require_once("phpmailer/src/OAuth.php");
require_once("phpmailer/src/POP3.php");

$email = "";
$msg = "";

$button = getPost("button");

if ($button == "send") {
    $isValid = true;
    // Sanitize email
    $email = clean(getPost("email"));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "El formato de correo electrónico no es válido";
        $isValid = false;
    }

    // Check email in database
    if ($isValid) {
        $sql = "SELECT * FROM student WHERE email = ?;";
        $res = $db->executeFetch($sql, [$email]);
        if (!$res) {
            $msg = "El correo electrónico no está registrado";
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
            $message = "<p>Tu contraseña se ha reiniciado.</p>";
            $message .= "<p>Tu nueva contraseña es: <b>{$newPass}</b></p>";
            $message .= "<p>Recuerda que puedes cambiar tu contraseña en los datos de tu cuenta en la web de TecniKanto.</p>";
            $mail->IsHTML (true);
            $mail->MsgHTML($message);

            // Send
            try {
                $mail->send();
                $msg = "Se ha enviado un correo a <b>{$email}</b>";
            } catch (Exception $e) {
                $msg = "No se ha podido enviar el correo electrónico";
                $isValid = false;
            }
        }
    }
} else {
    $isValid = false;
}
