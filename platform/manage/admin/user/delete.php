<?php
session_start();

include_once("controllers/user_controller.php");

$user = new UserController();
$user->deleteUser($_GET['id']);
?>