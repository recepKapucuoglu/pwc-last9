<?php include('dosyalar/dahili/header.php');
error_reporting(E_ALL);
ini_set('display_error',1);

$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/", $page_url);
$page_url = end($page_url);
if (strpos($page_url, '?') !== false) {

	$page_url = explode("?", $page_url);
	$page_url = $page_url[0];
}
$page_url = t_decode($page_url);

	//aciklamayi çekelim

	$db->where('seo_url',$page_url);
	$page_icerik= $db->getOne('page');
	$icerik=t_decode($page_icerik['aciklama']);
    $baslik=t_decode($page_icerik['baslik']);
    $resim_alt_etiket=t_decode($page_icerik['resim_alt_etiket']);


?>


<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
	<div class="basliklar">
		<div class="baslik"><?php echo $baslik ?></div>
		<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
				<meta itemprop="position" content="1" />
			</li>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="javascript:;"><span itemprop="name"><?php echo $resim_alt_etiket ?></span></a>
				<meta itemprop="position" content="2" />
			</li>
		</ol>
	</div>
</section>
<section style="margin-top:30px">
<div class="container"><?php
 echo  $icerik ;
?></div>
	<div class="education-type">
		<div class="container education-type__container">
			<div class="education-type_container">
				<div>
					<div id="educationCategory">
						<span>
							Eğitim Kategorileri
						</span>
						<img id="educationLevelDown" src="dosyalar/images/down-arrow.png" />
					</div>
				</div>
				<div>
					<div id="educationType" style="display:none">
						<span>
							<? if (isset($_POST['selectedTypes'])) {
								$selectedTypes = $_POST['selectedTypes'];
								echo $selectedTypes;
								// $selectedTypes, seçilen türlerin bir dizi halinde değerlerini içerir
							
								// Veritabanı sorgusunda seçilen türleri filtrelemek için buraya kod yazabilirsiniz
							} ?>
							Eğitim Tipi
						</span>
						<img id="educationTypeDown" src="dosyalar/images/down-arrow.png" />
					</div>
				</div>
				<div>
					<div id="educationLevel">
						<span>
							Eğitim Seviyesi
						</span>
						<img id="educationLevelDown" src="dosyalar/images/down-arrow.png" />
					</div>
				</div>
				<!-- <div>
					<div id="educationLocation">
						<span>
							Lokasyon
						</span>
						<img id="educationLocationDown" src="dosyalar/images/down-arrow.png" />
					</div>
				</div> -->
			</div>
			<div class="education-type_search-container">
				<input type="text" placeholder="Arama..." class="education-type_search" id="search-input" />
				<div class="search-icon__education-type">
					<img src="dosyalar/images/search.png"
						style="filter: invert(13%) sepia(0%) saturate(3436%) hue-rotate(317deg) brightness(108%) contrast(90%); cursor:pointer" />
				</div>
			</div>
		</div>
	</div>

	<div class="education-level" id="education" style="display:none">
		<div class="container">
			<div class="education-type_container" id="educationTypeContainer" style="display:none">
				<?php
				$query = "SELECT DISTINCT types FROM egitimlerimiz_filter WHERE types IS NOT NULL ";
				$type_list = $db->rawQuery($query);
				foreach ($type_list as $type) {
					?>
					<div style="margin-right:25px">
						<input class="egitim-filtre" type="checkbox" id="<?php echo $type['types'] ?>"
							name="<?php echo $type['types'] ?>" value="<?php echo $type['types'] ?>">
						<label for="<?php echo $type['types'] ?>"><?php echo $type['types'] ?></label><br>
					</div>
				<?php } ?>
			</div>
			<div class="education-type_container" id="educationLevelContainer" style="display:none">
				<?php
				//level_idsi olmayanlar gelmesin 
				$query = "SELECT DISTINCT level_id FROM egitimlerimiz_filter WHERE level_id IS NOT NULL AND types = 'E-Learning'";
				$level_list = $db->rawQuery($query);
				foreach ($level_list as $level) {
					if ($level['level_id'] == 1) {
						$level_adi = "Başlangıç";
					}
					if ($level['level_id'] == 2) {
						$level_adi = "Orta";
					}
					if ($level['level_id'] == 3) {
						$level_adi = "İleri Seviye";
					}
					?>
					<div style="margin-right:25px">
						<input class="egitim-filtre" type="checkbox" id="<?php echo $level_adi ?>"
							name="<?php echo $level_adi ?>" value="<?php echo $level['level_id'] ?>">
						<label for="<?php echo $level_adi ?>"><?php echo $level_adi ?></label><br>
					</div>
				<?php } ?>
			</div>
			<div class="education-type_container" id="educationCategoryContainer" style="display:none">
				<?php
				//KATEGORİSİNDE AKTİF EGİTİM OLANLARI GETİRELİM
				$query = "SELECT  kategoriler FROM egitimlerimiz_filter WHERE kategoriler IS NOT NULL AND types = 'E-Learning' ";
				$category_list = $db->rawQuery($query);
				$uniqueCategories = array();

				foreach ($category_list as $value) {
					$categories = explode(", ", $value['kategoriler']);
					foreach ($categories as $category) {
						$uniqueCategories[$category] = true;
					}
				}
				foreach ($uniqueCategories as $category => $value) {
					$db->where('baslik', "$category");
					$dd = $db->getOne('categories');
					$id = $dd['id'];
					?>
					<div class="egitim-filtre_container">
						<div style="display:flex; align-items:center">
							<input class="egitim-filtre" type="checkbox" id="category_<?php echo $id; ?>"
								name="<?php echo $category; ?>" value="<?php echo $category ?>">
							<label for="category_<?php echo $id ?>"><?php echo $category ?></label><br>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="education-type_container" id="educationLocationContainer" style="display:none">
				<?php
				$query = "SELECT DISTINCT sehir_adi from egitimlerimiz_filter where sehir_adi IS NOT NULL";
				$location_list = $db->rawQuery($query);
				foreach ($location_list as $location) {
					if ($location['sehir_adi'] != 'Elearning') {
						?>
						<div class="egitim-filtre_container">
							<div style="display:flex; align-items:center">
								<input class="egitim-filtre" type="checkbox" id="location_<?php echo $location['sehir_adi']; ?>"
									name="deneme" value="<?php echo $location['sehir_adi'] ?>">
								<label for="location_<?php echo $location['sehir_adi']; ?>"><?php echo $location['sehir_adi']; ?></label><br>
							</div>
						</div>
					<?php }
				}
				?>
			</div>
		</div>
	
	</div>

	<div class="container" style="margin-bottom:30px; margin-top:30px;">
		<div class="row list-filters-items">

		</div>
		<!-- PAGİNATİON -->
		<div style='margin-top:25px; width: 100%; display:flex; justify-content:center;'>
			<div style='padding:0px 20px; display:inline-block; background:#ffb600; margin-right:25px'
				class="dfazla_goruntule2">

				<!-- <div id="dahafazla geri_paginate" onclick="return filter_back_page()" class="dahafazla">Tümünü Göster</div> -->

				<!-- <a class="pagination-count" onclick="return education_more_page();"></a> -->


				<div id="dahafazla ileri_paginate" onclick="return filter_next_page()" class="dahafazla">Daha Fazla
					Görüntüle</div>

			</div>
			<div style='padding:0px 20px; display:inline-block; background:#2d2d2d' class="tumunu_goruntule">
				<div class="dahafazla tumunu_goruntule" style="color:#fff">Tümünü Görüntüle</div>
			</div>
		</div>
	</div>
</section>
<section class="action" style="margin-bottom:20px">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="action-body__contact">
					<p>PwC çözümleri hakkında daha fazla bilgi edinmek için bize ulaşın</p>
					<div class="action-body__info">
						<p><a href="/iletisim" style="color:#2d2d2d">Bilgi ve Teklif Talep Formu</a></p>
					</div>
					<div class="action-body_button">
						<a class="bilgi-al" href="/iletisim">Bilgi Al</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>

	var pagination = 1;
	var selectedTypes=['E-Learning'];
	var selectedCategories;
	var selectedLocations;
	var searchTerm;

	$('.tumunu_goruntule').click(function () {

		searchTerm = $('#search-input').val();
		page_url = $('#page_url').val();
		var allPage = 1;
		console.log(allPage);
		$.ajax({
			url: "/egitimlerimiz_filter.php",
			type: "POST",
			data: {
				selectedTypes: selectedTypes,
				selectedCategories: selectedCategories,
				selectedLocations: selectedLocations,
				allPage: allPage,
				page_url: page_url,
				searchTerm: searchTerm,
			},
			success: function (cevap) {
				$('.list-filters-items').html(cevap);
			},
		});
	});
	//arama butonu tıklandıgında
	$('.search-icon__education-type').click(function () {
		var selectedTypes=['E-Learning'];
		selectedCategories = [];
		selectedLocations = [];
		pagination = 1;
		searchTerm = $('#search-input').val();

		// Burada searchTerm değişkeni ile input alanındaki değeri alıyoruz.
		console.log(searchTerm);
		$.ajax({
			url: "/egitimlerimiz_filter.php",
			type: "POST",
			data: {

				searchTerm, searchTerm,
				pagination: pagination,
				isElearningEgitimleri:1,
			},
			success: function (cevap) {
				$('.list-filters-items').html(cevap);
			},
		});
		// Arama sayfasına yönlendiriyoruz ve URL'e searchTerm değerini ekliyoruz.
	});
	//eğitimleri filterle çek
	$('.education-type_container input[type=checkbox]').on('change', function () {
		var selectedTypes=['E-Learning'];
		selectedCategories = [];
		selectedLocations = [];
		pagination = 1;
		$('.education-type_container input[type=checkbox]:checked').each(function () {
			if ($(this).closest('.education-type_container').attr('id') == 'educationTypeContainer') {
				selectedTypes.push($(this).val());
			}
			if ($(this).closest('.education-type_container').attr('id') == 'educationCategoryContainer') {
				selectedCategories.push($(this).val());
			}
			if ($(this).closest('.education-type_container').attr('id') == 'educationLevelContainer') {
				selectedTypes.push($(this).val());
			}
			if ($(this).closest('.education-type_container').attr('id') == 'educationLocationContainer') {
				selectedLocations.push($(this).val());
			}
		});
		console.log(pagination);
		console.log(selectedTypes);
		console.log(selectedCategories);
		console.log(selectedLocations);

		$.ajax({
			url: "/egitimlerimiz_filter.php",
			type: "POST",
			data: {
				selectedTypes: selectedTypes,
				selectedCategories: selectedCategories,
				selectedLocations: selectedLocations,
				pagination: pagination,

			},
			success: function (cevap) {
				$('.list-filters-items').html(cevap);
			},
		});
	});
	$('#ileri_paginate').click(function () {
		console.log("ss");
		// Your code here
	});
	//sayfa yüklendiği anda tüm eğitimleri çek
	$(document).ready(function () {
		pagination = 1;
		console.log(pagination);
		$.ajax({
			url: "/egitimlerimiz_filter.php",
			type: "POST",
			data: {
				pagination: pagination,
				selectedTypes:selectedTypes
			},
			success: function (cevap) {
				$('.list-filters-items').html(cevap);
			},
		});
	});

	function filter_next_page() {
		pagination = pagination + 1;
		console.log(pagination);
		$.ajax({
			url: "/egitimlerimiz_filter.php",
			type: "POST",
			data: {
				selectedTypes: selectedTypes,
				selectedCategories: selectedCategories,
				selectedLocations: selectedLocations,
				pagination: pagination,
				searchTerm: searchTerm,
			},
			success: function (cevap) {
				$('.list-filters-items').html(cevap);
			},
		});
		return false; // sayfa yenilenmesini önlemek için false değer döndürür
	}
	function filter_back_page() {
		if (pagination >= 2) {
			pagination = pagination - 1;
			console.log(pagination);
			$.ajax({
				url: "/egitimlerimiz_filter.php",
				type: "POST",
				data: {
					selectedTypes: selectedTypes,
					selectedCategories: selectedCategories,
					selectedLocations: selectedLocations,
					pagination: pagination,
				},
				success: function (cevap) {
					$('.list-filters-items').html(cevap);
				},
			});
		}

		return false; // sayfa yenilenmesini önlemek için false değer döndürür
	}

</script>

<?php include('dosyalar/dahili/footer.php'); ?>