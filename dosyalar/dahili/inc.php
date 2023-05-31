<?php
require_once('_db.php');
require __DIR__ . "/verify_check.php";




$page_url = $_SERVER["REQUEST_URI"];
$page_url = explode("/", $page_url);
$page_url_egitim = explode("?", $_SERVER["REQUEST_URI"]);
$prev_url_egitim = prev($page_url_egitim);

$son_url = end($page_url);
$prev_url = prev($page_url);


if ($page_url_egitim[0] == "/egitimlerimiz") {
	$url_rewrite = "egitimlerimiz.php";

} else if ($prev_url == "bilgi-formu") {
	$url_rewrite = "bilgi-al.php";

} else if ($son_url == "sifremi-unuttum") {
	$url_rewrite = "sifremi-unuttum.php";

} else if ($prev_url == "katilimcilar") {
	$url_rewrite = "sepet-katilimcilar.php";

} else if ($prev_url == "sepet") {
	$url_rewrite = "sepet.php";

} else if ($prev_url == "sepet-fatura") {
	$url_rewrite = "sepet-fatura.php";

} else if ($prev_url == "sepet-odeme") {
	$url_rewrite = "sepet-odeme.php";

} else if ($prev_url == "uyelik" or $son_url == "uyelik") {
	$url_rewrite = "login-redirect.php";

} else if ($prev_url == "sepet-ozet") {
	$url_rewrite = "sepet-ozet.php";

} else if ($prev_url == "siparis-sonuc") {
	$url_rewrite = "siparis-sonuc.php";

} else if ($prev_url == "sepet-sonuc") {
	$url_rewrite = "sepet-sonuc.php";

} else if ($prev_url == "platform") { // platform için ekledim!!!!
	$url_rewrite = "platform/index.php";

} else if ($prev_url == "next-business") { // next-business için ekledim!!!!! 
	$url_rewrite = "next-business/index.html";

} else if ($prev_url == "panel") { // panel için ekledim!!!!! 
	$url_rewrite = "panel/index.php";

}else if ($prev_url == "egitim-takvimi") { // takvim için ekledim!!!!! 
	$url_rewrite = "egitim-takvimi.php";

} else if ($prev_url == "blog" or $son_url == "blog") {
	$url_rewrite = "blog.php";
} else if ($prev_url == "sss" or $son_url == "sss") {
	$url_rewrite = "sss.php";
}
// else if ($prev_url == "e-learning-egitimleri" or $son_url == "e-learning-egitimleri") {
// 	$url_rewrite = "e-learning-egitimleri.php";
// }
 else {
	$page_url = end($page_url);
	if (strpos($page_url, '?') !== false) {

		$page_url = explode("?", $page_url);
		$page_url = $page_url[0];
	}

	$page_url = valueClear($page_url);
	$page_url = t_decode($page_url);
	$db->where('seo_url', $page_url);
	$total = $db->getValue('url_list', "count(id)");
	if ($total > 0) {
		$db->where('seo_url', $page_url);
		$results = $db->get('url_list');
		foreach ($results as $value) {
			$url_rewrite = $value['site_url'];
			$ozel_title = $value['meta_title'];
			$ozel_keywords = $value['meta_keywords'];
			$ozel_description = $value['meta_description'];
		}
	} elseif ($page_url == "")
		$url_rewrite = "index.php";
	else {
		$url_rewrite = "404.php";
	}

}


// Site Özel Meta Ayarları
if ($ozel_title <> "")
	$site_title = $ozel_title;
if ($ozel_keywords <> "")
	$site_keywords = $ozel_keywords;
if ($ozel_description <> "")
	$site_description = $ozel_description;