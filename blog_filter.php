<?php 
require_once('dosyalar/dahili/_db.php');
$page= $_POST['pagination'];
$allPage=$_POST['allPage'];
echo $page;
$db->where('durum',1);
$totalBlog = $db->getValue('blog', "count(id)");
	$totalPage = ceil($totalBlog / 8);

	if ($page == 1)
	$limit = 8;
 	$limit = 8 + (($page - 1) * 8);
$query="SELECT * FROM blog WHERE durum = 1 ORDER BY kayit_tarihi DESC LIMIT $limit ";
if($allPage)
$query="SELECT * FROM blog WHERE durum = 1 ORDER BY kayit_tarihi DESC ";

$res = $db->rawQuery($query);

if($allPage || ($page>=$totalPage)){
	echo 
	"<script> 
	$('.tumunu_goruntule').hide();
	$('.dahafazla').hide();
	</script>";
	}
// $res = $db->get('blog');
foreach ($res as $r) {
	$aciklama=t_decode($r['alt_baslik']);

	echo "<div class='col-xs-12 col-sm-6 col-md-3 col-lg-3 square-card'>
			<a href='" . $r['seo_url'] . "'>
				<div class='square'>
					<img src='https://www.okul.pwc.com.tr/" . $r['banner'] . "' class='mask'>
					<div class='square-body'>
						<div class='h1'>" . $r['baslik'] . "</div>
						<p>" . $aciklama . "</p>
				
						<div style='position:absolute; bottom:5%; left:10%;'>
							<a href=".$r['seo_url']." class='button'>Daha Fazla</a>
						</div>
					</div>
				</div>
			</a>
		  </div>";
}

?>