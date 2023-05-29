<?php
session_start();
include_once('../manage/config/database.php');
$email = trim(htmlspecialchars($_POST["name"]));
// Valid mail kontrol
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<div class="alert alert-warning">
<strong>Uyarı!</strong> Giriş bilgileriniz yanlış, lütfen kontrol ediniz. </div>';
    $_SESSION["error"] = true;
    header("Location: https://www.okul.pwc.com.tr/platform/giris/index.php");
    exit();
}
$pdo = Database::connect();
$sql = $pdo->prepare("SELECT * FROM event_signup WHERE sirketmail=:mail");
$sql->execute(['mail' => $email]);
$fetch = $sql->fetch();
if($sql->rowCount() > 0){
    $_SESSION["mail"] = $fetch["sirketmail"];
    $_SESSION["isim"] = $fetch["isim"];
	$_SESSION["tel"] = $fetch["ceptelefon"];
    $_SESSION["error"] = false;
    header("Location: https://www.okul.pwc.com.tr/platform/giris/calendar.php");
} else {
    echo '<div class="alert alert-warning">
<strong>Uyarı!</strong> Giriş bilgileriniz yanlış, lütfen kontrol ediniz. </div>';
    $count = $sql->rowCount();
    header("Location: https://www.okul.pwc.com.tr/platform/giris/index.php?a=$count");
    $_SESSION["error"] = true;
}
Database::disconnect();