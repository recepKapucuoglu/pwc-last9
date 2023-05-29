<?php
require_once("inc.php");


$hata_mesaj_mail = '<div class="alert alert-danger"><strong>Uyarı!</strong> Girmiş olduğunuz <b>Kullanıcı Email</b> veya <b>Şifre</b> bilgileriniz hatalı.</div>';
$hata_mesaj_phone = '<div class="alert alert-danger"><strong>Uyarı!</strong> Girmiş olduğunuz <b>Kullanıcı Telefon</b> veya <b>Şifre</b> bilgileriniz hatalı.</div>';

$last_page_url=$_POST['last_page_url']; //kullanıcı nereden geldi son sayfayı yakala

if ($_POST['email_login']) {
	

	//TELEFON NUMARASI İLE GELEN KULLANICI
	if (strpos($_POST['email_login'], '@') === false) {		
		$_SESSION['dashboardUserStatus'] = 0;
		$phone = valueClear($_POST['email_login']);
		//girilen telefon no formatını kontrol edelim		
		$regex = '/^0\(\d{3}\)\s\d{3}-\d{4}$/';
		if (!preg_match($regex, $phone)) { 
			$phone = preg_replace('/^0(\d{3})(\d{3})(\d{2})(\d{2})$/', '0($1) $2-$3$4', $phone);
		} 
		$phone = preg_replace('/^0(\d{3})(\d{3})(\d{2})(\d{2})$/', '0($1) $2-$3$4', $phone);
		$password = valueClear($_POST['password']);
		$redirect_url = valueClear($_POST['redirect_url']);
		$last_page_url = valueClear($_POST['last_page_url']); // son kaldıgı sayfa.
		$rememberme = valueClear($_POST['rememberme']);
		$db->where('phone', $phone);
		$logged_user = $db->getOne('web_user');
		if (webUserPasswordVerify($password, $logged_user["password"])) {
			$_SESSION['dashboardUser'] = $logged_user["email"];
			$_SESSION['dashboardUserPhone'] = $logged_user["phone"];

			if ($rememberme == 1) {
				setcookie("usernameCerez", $phone, time() + 86400 * 30, '/');
				setcookie("passwordCerez", $password, time() + 86400 * 30, '/');
			} else {
				setcookie("usernameCerez", "", time() + 86400 * 30, '/');
				setcookie("passwordCerez", "", time() + 86400 * 30, '/');
			}
			$db->where('phone', $_SESSION['dashboardUserPhone']);
			$results = $db->get('web_user');
			foreach ($results as $value) {
				$_SESSION['dashboardUserName'] = $value['fullname'];
				$_SESSION['dashboardUserId'] = $value['id'];
				$_SESSION['dashboardUserPhone'] = $value['phone'];
			}
			$dataLogon = array('last_login_date' => $db->now() ,'last_page_url' => $last_page_url);
			$db->where('phone', $_SESSION['dashboardUserPhone']);
			$idLogon = $db->update('web_user', $dataLogon);
			if ($last_page_url <> "")
				echo "<script language=\"JavaScript\">location.href=\"/katilimcilar/" . $last_page_url . "\";</script>";
			else
				echo "<script language=\"JavaScript\">location.href=\"/dashboard.php\";</script>";
		} else {

			echo $hata_mesaj_phone;
		}
	} else {
		//MAİL İLE GELEN KULLANICI
		$_SESSION['dashboardUserStatus'] = 0;
		$email = valueClear($_POST['email_login']);
		$password = valueClear($_POST['password']);
		$redirect_url = valueClear($_POST['redirect_url']);
		$rememberme = valueClear($_POST['rememberme']);

		$db->where('email', $email);
		$logged_user = $db->getOne('web_user');
		if (webUserPasswordVerify($password, $logged_user["password"])) {
			$_SESSION['dashboardUser'] = $email;
			if ($rememberme == 1) {
				setcookie("usernameCerez", $email, time() + 86400 * 30, '/');
				setcookie("passwordCerez", $password, time() + 86400 * 30, '/');
			} else {
				setcookie("usernameCerez", "", time() + 86400 * 30, '/');
				setcookie("passwordCerez", "", time() + 86400 * 30, '/');
			}
			$db->where('email', $_SESSION['dashboardUser']);
			$results = $db->get('web_user');
			foreach ($results as $value) {
				$_SESSION['dashboardUserName'] = $value['fullname'];
				$_SESSION['dashboardUserId'] = $value['id'];
				$_SESSION['dashboardUserPhone'] = $value['phone'];
			}
			$dataLogon = array('last_login_date' => $db->now() ,'last_page_url' => $last_page_url);
			$db->where('email', $_SESSION['dashboardUser']);
			$idLogon = $db->update('web_user', $dataLogon);
			if ($last_page_url <> "")
			
				echo "<script language=\"JavaScript\">location.href=\"/katilimcilar/" . $last_page_url . "\";</script>";
			else
			echo "<script language=\"JavaScript\">location.href=\"/katilimcilar/" . $last_page_url . "\";</script>";
		} else {

			echo $hata_mesaj_mail;
		}
	}


} else {

	echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
}
?>