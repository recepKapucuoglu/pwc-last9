<?php
session_start();
if(!isset($_SESSION["mail"]) || empty($_SESSION["mail"])){
    header("Location: https://www.okul.pwc.com.tr/platform/giris/index2.php");
}