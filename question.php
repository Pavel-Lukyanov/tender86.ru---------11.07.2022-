<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP();
//$mail -> SMTPDebug = SMTP :: DEBUG_SERVER ;                                    
$mail->Host         = 'smtp.mail.ru';
$mail->SMTPAuth     = true;
$mail->Username     = 'noreply@tender86.ru'; // Если почта для домена, то логин это полный адрес почты
$mail->Password     = 'Pa3Hr)RrtR5u'; //пароль
$mail->SMTPSecure   = 'ssl';
$mail->Port         = 465;

// Авторизация
$mail->CharSet = 'UTF-8';
$mail->setFrom('noreply@tender86.ru'); //почта с которой производится отправка
$mail->addAddress('tender_rus@list.ru'); //Почта на которую производится отправка

// Контент                   
$mail->isHTML(true);
$mail->Subject = 'Заявка с сайта: Выигрываем тендеры';
$mail->Body    = 'Информационное сообщение c сайта tender86.ru <br><br>
------------------------------------------<br>
<br>
Вам было отправлено сообщение через форму обратной связи "Есть вопросы?"<br>
<br>
Телефон: ' . $_POST['phone'] . '<br>
Имя: ' . $_POST['name'] . '<br>

<br>
Сообщение сгенерировано автоматически.';

if (!$mail->send()) :
    $message = 'Ошибка!';
    $response = array('message' => $message, 'error' => true);
else :
    $message = 'Отправлено &#10004;';
    $response = array('message' => $message, 'error' => false);
endif;



header('Content-type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);

exit;
