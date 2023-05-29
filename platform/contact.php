<?php
error_reporting(E_ALL ^ E_NOTICE);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = sanitize_input($_POST["name"]);
    $company = sanitize_input($_POST["email"]);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $degree = sanitize_input($_POST["degree"]);
    $phone = sanitize_input($_POST["phone"]);
    $cellphone = sanitize_input($_POST["cellphone"]);
    $legacy = isset($_POST['aydinlatma']);
    $alumni = isset($_POST['alumni']);
    // Check that data was sent to the mailer.
    if (!$legacy or empty($name) or empty($company) or empty($degree) or empty($cellphone) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        response_builder(400, "Lütfen tüm alanları doldurunuz.");
    } else {
        response_builder(200, "Tebrikler.");
    }
    exit;
} else {
    response_builder(403, 'Geçersiz istek.');
}


function sanitize_input($data)
{
    $data = trim($data);
    $data = filter_var($data, FILTER_SANITIZE_STRING);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function response_builder($statusCode, $message)
{
    $response = array(
        "statusCode" => $statusCode,
        "message" => $message
    );
    http_response_code($statusCode);
    echo $message;
    exit;
}
