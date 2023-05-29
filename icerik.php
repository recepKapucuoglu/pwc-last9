<?php include('dosyalar/dahili/header.php');

$page_url = $_SERVER["REQUEST_URI"];
$page_url = explode("/",$page_url);
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('page');
foreach ($results as $value) {
	$baslik=$value['baslik'];
	$aciklama=t_decode($value['aciklama']);
}

?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik"><?php echo $baslik; ?></div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="javascript:;"><span itemprop="name"><?php echo $baslik; ?></span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<article>
						<?php echo $aciklama; ?>
					</article>
				</div>
			</div>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>