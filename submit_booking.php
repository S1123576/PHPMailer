<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 引入 PHPMailer 類別
require 'vendor/autoload.php';

// 獲取表單數據
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$date = $_POST['date'];
$volume = $_POST['volume'];
$type = $_POST['type'];

// 檢查必要字段
if (empty($name) || empty($phone) || empty($email)) {
    die("請完整填寫表單資料！");
}

// 配置 PHPMailer
$mail = new PHPMailer(true);

try {
    // 設定 SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // 使用 Gmail SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'victoriahuang29@gmail.com'; // 改為你的 Gmail
    $mail->Password = 'D223287181'; // Gmail 應用程式密碼
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // 收件人
    $mail->setFrom('your-email@gmail.com', 'EcoClean');
    $mail->addAddress($email, $name);

    // 郵件內容
    $mail->isHTML(true);
    $mail->Subject = 'EcoClean 預約成功通知';
    $mail->Body    = "
        <h2>感謝您預約 EcoClean 垃圾清運服務！</h2>
        <p><strong>預約詳情：</strong></p>
        <ul>
            <li>姓名 / Name: $name</li>
            <li>聯絡電話 / Phone: $phone</li>
            <li>地址 / Address: $address</li>
            <li>預約日期 / Date: $date</li>
            <li>垃圾體積 / Waste Volume: $volume</li>
            <li>垃圾種類 / Waste Type: $type</li>
        </ul>
        <p>我們將盡快與您聯繫！</p>
    ";

    // 發送郵件
    $mail->send();
    echo "預約成功，確認信已發送至您的電子郵件！";
} catch (Exception $e) {
    echo "郵件發送失敗：{$mail->ErrorInfo}";
}

// 跳轉到確認頁面
header("Location: confirmation.html");
exit;
?>
