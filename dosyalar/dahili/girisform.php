
<?php 
require_once('_db.php'); 
//kullanıcını bir yerden buraya yönlenmişse giriş yaptıktan sonra tekrar aynı yerine yönlendirelim.

$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/", $page_url);
$page_url = end($page_url);
if (strpos($page_url, '?') !== false) {

	$page_url = explode("?", $page_url);
	$page_url = $page_url[0];
}
if($page_url!='uyelik'){
	$last_page_url = t_decode($page_url);

}
?>
<form id="login_form" method="post" class="girisform " onsubmit="return login_send();">

<div class="loginFormList" style="text-align:left">
			</div>
	<div class="baslik">
		<b>Giriş Yap</b>
		<!-- <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $redirect_url; ?>" /> -->
		<input type="hidden" name="last_page_url" id="last_page_url" value="<?php echo $last_page_url; ?>" />
	</div>
	<div class="label-div2">
		<label for="email">Mail/Telefon</label>
		<input type="text" name="email_login" id="email_login" value="<?php if(isset($_COOKIE['usernameCerez'])) echo $_COOKIE['usernameCerez'];?>" required />
	</div>
	<div class="label-div2">
		<label for="sifre">Şifre</label>
		<input type="password" name="password" id="password" value="<?php if(isset($_COOKIE['passwordCerez'])) echo $_COOKIE['passwordCerez'];?>" required />
	</div>
	
	<div class="label-div2 temizle">
		<span class="checkbox-div">
			<input class="magic-checkbox" type="checkbox" id="rememberme" name="rememberme" value="1" <?php if(isset($_COOKIE['passwordCerez'])) echo "checked"; ?>/>
			<label for="rememberme" style="font-size:13px; float:left">Beni Hatırla</label>
		</span>
		<a href="/sifremi-unuttum" class="sifreunuttum">Şifremi Unuttum</a>

	</div>
	<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return login_send();"><span>Giriş Yap</span></a></div>
	
</form>