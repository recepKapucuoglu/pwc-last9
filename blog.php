<?php include('dosyalar/dahili/header.php');


?>
<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">BLOG</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="javascript:;"><span itemprop="name">Blog</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>

<section class="ortakisim container">
    <div class="row list_blog"> 

	<?php
	// if(!$_GET['page'])
	// $page = 1;
	// $page=$_GET['page'];
	// $db->where('durum',1);
	// $totalBlog = $db->getValue('blog', "count(id)");
	// $totalPage = ceil($totalBlog / $page);

	// if ($page == 1)
	// $limit = 2;
 	// $limit = 2 + (($page - 1) * 2);
	//  $query="SELECT * FROM blog WHERE durum = 1 ORDER BY kayit_tarihi DESC ";
	// $res = $db->rawQuery($query);
	
	// // $res = $db->get('blog');
	// foreach ($res as $r) {
	// 	$aciklama=t_decode($r['alt_baslik']);

	// 	echo "<div class='col-xs-12 col-sm-6 col-md-3 col-lg-3 square-card'>
	// 			<a href='" . $r['seo_url'] . "'>
	// 				<div class='square'>
	// 					<img src='https://www.okul.pwc.com.tr/" . $r['banner'] . "' class='mask'>
	// 					<div class='square-body'>
	// 						<div class='h1'>" . $r['baslik'] . "</div>
	// 						<p>" . $aciklama . "</p>
					
	// 						<div style='position:absolute; bottom:5%; left:10%;'>
	// 							<a href=".$r['seo_url']." class='button'>Daha Fazla</a>
	// 						</div>
	// 					</div>
	// 				</div>
	// 			</a>
	// 		  </div>";
	// }
	
?>
    </div>
	<!-- pagination -->
		<div style='margin-top:25px; width: 100%; display:flex; justify-content:center;'>
			<div style='padding:0px 20px; display:inline-block; background:#ffb600; margin-right:25px'
				class="dfazla_goruntule">

				<!-- <div id="dahafazla geri_paginate" onclick="return filter_back_page()" class="dahafazla">Tümünü Göster</div> -->

				<!-- <a class="pagination-count" onclick="return education_more_page();"></a> -->


				<div style="color:#2d2d2d" id="dahafazla ileri_paginate" onclick="return filter_next_page()" class="dahafazla ">Daha Fazla
					Görüntüle</div>

			</div>
			<div style='padding:0px 20px; display:inline-block; background:#2d2d2d;'>
					<div style="color:#fff" class="dahafazla tumunu_goruntule" onclick="return all_data_list()">Tümünü Görüntüle</div>
			</div>
		</div>

</section>
<script>
		var pagination = 1;
	function filter_next_page() {
		pagination = pagination + 1;
		console.log(pagination);
		$.ajax({
			url: "/blog_filter.php",
			type: "POST",
			data: {
				pagination: pagination,
			},
			success: function (cevap) {
				$('.list_blog').html(cevap);
			},
		});
		return false; // sayfa yenilenmesini önlemek için false değer döndürür
	}
	function all_data_list() {
		var allPage=1
		$.ajax({
				url: "/blog_filter.php",
				type: "POST",
				data: {
					allPage: allPage,
				},
				success: function (cevap) {
					$('.list_blog').html(cevap);
				},
			});
		
		return false; // sayfa yenilenmesini önlemek için false değer döndürür
	}
	//sayfa yüklendiği anda tüm eğitimleri çek
	$(document).ready(function () {
		pagination = 1;
		console.log(pagination);
		$.ajax({
			url: "/blog_filter.php",
			type: "POST",
			data: {
				pagination: pagination,
			},
			success: function (cevap) {
				$('.list_blog').html(cevap);
			},
		});
	});
</script>
<?php include('dosyalar/dahili/footer.php');?>