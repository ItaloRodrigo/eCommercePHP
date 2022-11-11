<?php

$formConfigFile = file_get_contents("rd-mailform.config.json");
$formConfig = json_decode($formConfigFile, true);

date_default_timezone_set('Etc/UTC');

try {
    require './phpmailer/PHPMailerAutoload.php';

    $recipients = $formConfig['recipientEmail'];
    $output = false;

    preg_match_all("/([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)/", $recipients, $addresses, PREG_OFFSET_CAPTURE);


    function getRemoteIPAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    // if (preg_match('/^(127\.|192\.168\.|::1)/', getRemoteIPAddress())) {
    //     die('MF002');
    // }

    $template = file_get_contents('rd-mailform.tpl');

    if (isset($_POST['form-type'])) {
        switch ($_POST['form-type']) {
            case 'contact':
                $subject = 'Uma Mensagem de Chipmatica';
                break;
            case 'subscribe':
                $subject = 'Pedido de Subscrição';
                break;
            case 'order':
                $subject = 'Ordem de Encomenda';
                break;
            default:
                $subject = 'Uma Mensagem do seu Cliente';
                break;
        }
    } else {
        die('MF004');
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $template = str_replace(
            array("<!-- #{FromState} -->", "<!-- #{FromEmail} -->"),
            array("Email:", $_POST['email']),
            $template
        );
    }

    if (isset($_POST['message'])) {
        $template = str_replace(
            array("<!-- #{MessageState} -->", "<!-- #{MessageDescription} -->"),
            array("Message:", $_POST['message']),
            $template
        );
    }

    // In a regular expression, the character \v is used as "anything", since this character is rare
    preg_match("/(<!-- #\{BeginInfo\} -->)([^\v]*?)(<!-- #\{EndInfo\} -->)/", $template, $matches, PREG_OFFSET_CAPTURE);
    foreach ($_POST as $key => $value) {
        if ($key != "counter" && $key != "email" && $key != "message" && $key != "form-type" && $key != "g-recaptcha-response" && !empty($value)) {
            $info = str_replace(
                array("<!-- #{BeginInfo} -->", "<!-- #{InfoState} -->", "<!-- #{InfoDescription} -->"),
                array("", ucfirst($key) . ':', $value),
                $matches[0][0]
            );

            $template = str_replace("<!-- #{EndInfo} -->", $info, $template);
        }
    }

    $template = str_replace(
        array("<!-- #{Subject} -->", "<!-- #{SiteName} -->"),
        array($subject, $_SERVER['SERVER_NAME']),
        $template
    );

    $mail = new PHPMailer();


    if ($formConfig['useSmtp']) {
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        $mail->Debugoutput = 'html';

        // Set the hostname of the mail server
        $mail->Host = $formConfig['host'];

        // Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = $formConfig['port'];

        // Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";

        // Username to use for SMTP authentication
        $mail->Username = $formConfig['username'];

        // Password to use for SMTP authentication
        $mail->Password = $formConfig['password'];
    }

    $mail->From = $_POST['email'];

    # Attach file
    if (
        isset($_FILES['file']) &&
        $_FILES['file']['error'] == UPLOAD_ERR_OK
    ) {
        $mail->AddAttachment(
            $_FILES['file']['tmp_name'],
            $_FILES['file']['name']
        );
    }

    if (isset($_POST['name'])) {
        $mail->FromName = $_POST['name'];
    } else {
        $mail->FromName = "Chipmatica";
    }

    $mail->addAddress($email);

    foreach ($addresses[0] as $key => $value) {
        $mail->addAddress($value[0]);
    }
    //----
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $message = $_POST['message'];
    $contato = $_POST['phone'];
    //---
    global $con;
    $con = mysqli_connect("localhost", "root", "", "ecommerce");
    $con->set_charset("utf8");
    $query = "insert into contact(first_name,last_name,email,text,contato) values('$first_name','$last_name','$email','$message','$contato')";
    $result = mysqli_query($con, $query);
    if ($result) {
        $mail->CharSet = 'utf-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($template);
        $mail->send();
        //---
        // var_dump("Location: " . $_SERVER['HTTP_HOST'] . "/contact-ls.php?output=1");
        header("Location: " . $_SERVER['HTTP_HOST'] . "/contact-us.php?output=1");
        // die('Enviado com sucesso - MF000');
    }
} catch (phpmailerException $e) {
    die('MF254');
} catch (Exception $e) {
    die('MF255');
}
