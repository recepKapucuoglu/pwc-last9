<?php
session_start();
unset($_SESSION['useradmin']);
echo '<script language=\'javascript\'>location.href=\'login.php\'</script>';
?>