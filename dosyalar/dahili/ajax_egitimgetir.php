<?php
include('functions.php');

$egitimler = egitimler_db();

if ($_POST['gun']!='') {
	$gun = $_POST['gun'];
} else {
	$gun = date('Ymd');
}

if (isset($_POST['id'])) {
	$id = $_POST['id'];
}else{
	$id = '';
}

$y = date("Y", strtotime($gun));
$a = turkcetarih("F", date("F", strtotime($gun)));
$g = date("d", strtotime($gun));
$tarih = array($y,$a,$g);
$url_say = 0;
$echo = '';
foreach($egitimler as $key=>$ay){
	foreach($ay as $egitim){
		$etkinlikgun = $egitim["groupId"];
		$etkinlikid = $egitim["id"];
		if($etkinlikgun==$gun){
			if($egitim["url"]<>"")
				$url_say++;
			$class = ($etkinlikid==$id) ? 'aktif' : '';
			$echo .= '
			<div id="egitim-'.$egitim["id"].'" class="detay '.$class.'">
				<a href="'.$egitim["url"].'">
					<time>'.date("H:i", strtotime($egitim["start"])).'</time>
					<h4 class="baslik">'.$egitim["title"].'</h4>
					<p>'.$egitim["ozet"].'</p>
					<i class="yer">'.$egitim["yer"].'</i>
				</a>
			</div>
			';
		}
	}
}

if($echo=='' OR $url_say==0){
	$echo = '
	<div class="detay">
		<a href="#">
			<time></time>
			<h4 class="baslik">Eğitim Bulunmadı!</h4>
			<p></p>
			<i class="yer"></i>
		</a>
	</div>
	';
	echo json_encode(['code'=>404, 'msg'=>$echo, 'tarih'=>$tarih]);
}else{
	echo json_encode(['code'=>200, 'msg'=>$echo, 'tarih'=>$tarih]);
}