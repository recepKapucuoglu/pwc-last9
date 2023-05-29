<?php include('dosyalar/dahili/header.php');
$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/",$page_url);
$page_url_total = count($page_url);

//Kategori URL'sini buluyoruz.
$page_categories_url = $page_url_total - 2;
$kategori_seo_url = $page_url[$page_categories_url];
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('blog');
foreach ($results as $value) {
	$id=$value['id'];
	$banner = $value['banner'];
	$seo_url=$value['seo_url'];
    $meta_description=$value['meta_description'];
    $baslik=$value['baslik'];
	$aciklama=t_decode($value['aciklama']);

}

?>
<<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">Blog</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="blog"><span itemprop="name">Blog</span></a>
					<meta itemprop="position" content="2" />
				</li>
				<?php
					if($baslik<>""){
				?>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="<?php echo $seo_url; ?>"><span itemprop="name"><?php echo $baslik; ?></span></a>
					<meta itemprop="position" content="2" />
				</li>
				<?php } ?>
				
			</ol>
		</div>
	</section>

<section class="ortakisim container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div>
                <img src="https://www.okul.pwc.com.tr<?php echo $banner ?>"style="width:100%; height:auto;"/>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
            <div>
                <div class="blockquote-pwc">
                    <p class="h4"> <?php echo $baslik ?> </p>
					<?php echo $aciklama; ?>
				</div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('dosyalar/dahili/footer.php');?>