<?php include('dosyalar/dahili/header.php');
?>
<section class="slayt-egitim">
	<div class="container" style="padding:0px">
		<div class="row">
			<div class="col-md-8" style="padding:0px">
				<div class="container" style="padding:0px">
					<div class="row" style="padding:0px">
						<div class="col-md-12" style="padding-left:0px">
							<div class="baslik-genel_gorsel" style="margin-top: 15px;">
								<div class="baslik-genel_cover"></div>
								<h4 class="baslik-genel"
									style="font-size: 1.825rem; line-height: 1.3; color: #2d2d2d; z-index: 99; margin-top: 15px;">
									Öne Çıkan İçerikler
								</h4>
							</div>
						</div>

						<div class="col-md-12" style="padding:0px">
							<div class="">
								<?php
								$i = 0;
								$db->orderBy("sira", "asc");
								$db->where('durum', 1);
								$results = $db->get('slide');
								foreach ($results as $value) {
									$resim = $value['resim'];
									if ($value['sira'] == '0') {
										$colSize = "12";
									} else {
										$colSize = "6";
									}

									$html = "<div class='col-md-$colSize' style='padding-left:0px'>
													<div class='slayt'>
													<div class='saribg'>
														<div class='basliklar'>
															<a href='" . $value['url'] . "'><div class='baslik'>" . $value['baslik'] . "</div></a>
															<div class='icerik'>" . $value['aciklama'] . "</div>";
									if ($value['url'] <> "") {
										$html .= "<a href='" . $value['url'] . "' class='devami'>Daha Fazla Bilgi</a>";
									}
									$html .= "</div></div>
													<img src='" . $site_url . $value['resim'] . "' alt='" . $value['resim_alt_etiket'] . "' />
												</div></div>";

									echo $html;

									?>

								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4" style="padding:0px">
				<div id="egitimtakvimi">
					<div class="egitimtakvimi">
						<div class="takvimdetay">
							<div class="detaylar">
								<section class="scrollbar-rail">
									<div class="baslik-genel_gorsel">
										<div class="baslik-genel_cover"></div>
										<h4 class="baslik-genel">Yaklaşan Eğitimler</h4>
									</div>
									<?php
									if (isMobile())
										$egitimKayit = 10;
									else
										$egitimKayit = 5;
									$gun = date('Ymd');
									$echo = '';
									$dateToday = date("Y-m-d");
									$db->where('durum', 1);
									$db->where('egitim_tarih', $dateToday, '>=');
									$db->orderBy("egitim_tarih", "asc");
									$resultsCalender = $db->get('education_calender_list', array(0, $egitimKayit));
									foreach ($resultsCalender as $valueCalender) {

										$echo .= '
															<div id="egitim-' . $valueCalender["id"] . '" class="detay">
																<a href="' . $valueCalender["seo_url"] . '" style="flex:2;">
																	<time>' . date2Human($valueCalender['egitim_tarih']) . ' <span>' . date("H:i", strtotime($valueCalender['egitim_tarih'] . 'T' . $valueCalender['baslangic_saat'])) . ' - ' . date("H:i", strtotime($valueCalender['egitim_tarih'] . 'T' . $valueCalender['bitis_saat'])) . '</span></time>
																	<h4 class="baslik">' . t_decode($valueCalender['egitim_adi']) . '</h4>																	
																</a>
																<a href="' . $valueCalender["seo_url"] . '" class="common-education_image" style="flex:1;">
																	<img src="' . $valueCalender['resim'] . '"/>
																</a>
															</div>
															<div class="slayt-border-bottom"></div> 
														';

									}
									if ($echo == '') {
										echo '
														<div class="detay">
															<a href="#">
																<time></time>
																<h4 class="baslik">Eğitim Bulunmadı!</h4>
																<p></p>
																<i class="yer"></i>
															</a>
														</div>
														';
									} else {
										echo $echo;
									}
									?>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section style="margin-top:50px">
	<div class="container">
		<div class="baslik-genel_gorsel" style="margin-top: 15px;margin-bottom: 15px;">
			<div class="baslik-genel_cover"></div>
			<h4 class="baslik-genel"
				style="font-size: 1.825rem; line-height: 1.3; color: #2d2d2d; z-index: 99; margin-top: 15px;">
				Eğitimlerimiz
			</h4>
		</div>
	</div>
	<div class="education-type">
		<div class="container">
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
					<div id="educationType">
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
				<div>
					<div id="educationLocation">
						<span>
							Lokasyon
						</span>
						<img id="educationLocationDown" src="dosyalar/images/down-arrow.png" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="education-level" id="education" style="display:none">
		<div class="container">
			<div class="education-type_container" id="educationTypeContainer" style="display:none">
			<?php 
			//egitim tarihine göre
				$query = "SELECT DISTINCT types FROM egitimlerimiz_filter WHERE types IS NOT NULL AND (egitim_tarih > CURDATE() OR (YEAR(egitim_tarih) = YEAR(CURDATE()) AND MONTH(egitim_tarih) > MONTH(CURDATE())) OR YEAR(egitim_tarih) > YEAR(CURDATE()) OR types = 'E-Learning') ";
			//kayit tarihine göre
			// $query = "SELECT DISTINCT types FROM egitimlerimiz_filter WHERE types IS NOT NULL ";
			$type_list = $db->rawQuery($query);
				foreach ($type_list as $type) { 
			?>
				<div style="margin-right:25px">
					<input class="egitim-filtre" type="checkbox" id="<?php echo$type['types']?>" name="<?php echo $type['types']?>"
						value="<?php echo $type['types']  ?>">
					<label for="<?php echo $type['types']?>"><?php echo $type['types']  ?></label><br>
				</div>
				<?php } ?>
			</div>
			<div class="education-type_container" id="educationLevelContainer" style="display:none">
			<?php 
				//level_idsi olmayanlar gelmesin 
				//kayit tarihine göre
				// $query = "SELECT DISTINCT level_id FROM egitimlerimiz_filter WHERE level_id IS NOT NULL";
				//egitim tarihinine göre
				$query = "SELECT DISTINCT level_id FROM egitimlerimiz_filter WHERE level_id IS NOT NULL AND (egitim_tarih > CURDATE() OR (YEAR(egitim_tarih) = YEAR(CURDATE()) AND MONTH(egitim_tarih) > MONTH(CURDATE())) OR YEAR(egitim_tarih) > YEAR(CURDATE()) OR types = 'E-Learning') ";

				$level_list = $db->rawQuery($query);				
				foreach ($level_list as $level) { 
					if($level['level_id']==1){
						$level_adi = "Başlangıç";
					}
					if($level['level_id']==2){
						$level_adi = "Orta";
					}
					if($level['level_id']==3){
						$level_adi = "İleri Seviye";
					}
				?>
				<div style="margin-right:25px">
					<input class="egitim-filtre" type="checkbox" id="<?php echo $level_adi ?>" name="<?php echo $level_adi ?>" value="<?php echo $level['level_id'] ?>">
					<label for="<?php echo $level_adi ?>"><?php echo $level_adi ?></label><br>
				</div>
				<?php } ?>
			</div>
			<div class="education-type_container" id="educationCategoryContainer" style="display:none">
				<?php
				//KATEGORİSİNDE AKTİF EGİTİM OLANLARI GETİRELİM
				//kayit tarihine göre
				// $query = "SELECT  kategoriler FROM egitimlerimiz_filter WHERE kategoriler IS NOT NULL ";
				//egitim tarihine göre
				$query = "SELECT  kategoriler FROM egitimlerimiz_filter WHERE kategoriler IS NOT NULL AND (egitim_tarih > CURDATE() OR (YEAR(egitim_tarih) = YEAR(CURDATE()) AND MONTH(egitim_tarih) > MONTH(CURDATE())) OR YEAR(egitim_tarih) > YEAR(CURDATE()) OR types = 'E-Learning') ";

				$category_list = $db->rawQuery($query);
				$uniqueCategories = array();

				foreach ($category_list as $value) {
    			$categories = explode(", ", $value['kategoriler']);
    			foreach ($categories as $category) {
        		$uniqueCategories[$category] = true;
    			}
				}
				foreach ($uniqueCategories as $category => $value) {
					$db->where('baslik',"$category");
					$dd=$db->getOne('categories');
					$id= $dd['id'];
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
				//kayit tarihine göre
				// $query = "SELECT DISTINCT sehir_adi FROM egitimlerimiz_filter WHERE sehir_adi IS NOT NULL ";
				//egitim tarihine göre 
				$query = "SELECT DISTINCT sehir_adi FROM egitimlerimiz_filter WHERE sehir_adi IS NOT NULL AND (egitim_tarih > CURDATE() OR (YEAR(egitim_tarih) = YEAR(CURDATE()) AND MONTH(egitim_tarih) > MONTH(CURDATE())) OR YEAR(egitim_tarih) > YEAR(CURDATE()) OR types = 'E-Learning') ";
				$location_list = $db->rawQuery($query);
				foreach ($location_list as $location) { 
					if($location['sehir_adi']!='Elearning'){
				?>
					<div class="egitim-filtre_container">
					<div  style="display:flex; align-items:center">
						<input class="egitim-filtre" type="checkbox" id="location_<?php echo $location['sehir_adi']; ?>" name="deneme" value="<?php echo $location['sehir_adi'] ?>">
						<label for="location_<?php echo $location['sehir_adi']; ?>"><?php echo $location['sehir_adi']; ?></label><br>
					</div>
					</div>
				<?php }}
				?>
			</div>
		</div>
	</div>
	<div class="container" style="margin-bottom:30px; margin-top:30px">
		<div class="row list-filters-items">

		</div>
		<!-- PAGİNATİON -->
		<div style='margin-top:25px; width: 100%; display:flex; justify-content:center;'>
			<div style='padding:0px 20px; display:inline-block; background:#ffb600; margin-right:25px'
				class="dfazla_goruntule">

				<!-- <div id="dahafazla geri_paginate" onclick="return filter_back_page()" class="dahafazla">Tümünü Göster</div> -->

				<!-- <a class="pagination-count" onclick="return education_more_page();"></a> -->


				<div id="dahafazla ileri_paginate" onclick="return filter_next_page()" class="dahafazla ">Daha Fazla
					Görüntüle</div>

			</div>
			<div style='padding:0px 20px; display:inline-block; background:#2d2d2d;'>
				<a href="/egitimlerimiz">
					<div class="dahafazla tumunu_goruntule----" style="color:#fff">Tümünü Görüntüle</div>
				</a>
			</div>
		</div>
	</div>
</section>
<section id="sayilarlabiz">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="sayilarlakutu">
					<div class="sayi"><span class="saydir" data-to="23348"></span>+</div>
					<div class="icerik">
						<b>Katılımcı</b>
						<p>Eğitimlerimize <br />Katılan Kişi Sayısı</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="sayilarlakutu bordervar">
					<div class="sayi"><span class="saydir" data-to="1825"></span>+</div>
					<div class="icerik">
						<b>Eğitim</b>
						<p>Tamamlanan <br />Eğitim Sayısı</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="sayilarlakutu ">
					<div class="sayi"><span class="saydir" data-to="12"></span>+</div>
					<div class="icerik">
						<b>Kategori</b>
						<p>Eğitim Verilen <br />Kategori Sayısı</p>
					</div>
				</div>
			</div>

		</div>
	</div>

</section>
<section class="action" style="margin-bottom:20px; margin-top:20px">
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
	var selectedTypes;
	var selectedCategories;
	var selectedLocations;
	var searchTerm;

	// $('.tumunu_goruntule').click(function () {

	// 	searchTerm = $('#search-input').val();
	// 	page_url = $('#page_url').val();
	// 	var allPage = 1;
	// 	console.log(allPage);
	// 	$.ajax({
	// 		url: "/index_filter.php",
	// 		type: "POST",
	// 		data: {
	// 			selectedTypes: selectedTypes,
	// 			selectedCategories: selectedCategories,
	// 			selectedLocations: selectedLocations,
	// 			allPage: allPage,
	// 			page_url: page_url,
	// 			searchTerm: searchTerm,
	// 		},
	// 		success: function (cevap) {
	// 			$('.list-filters-items').html(cevap);
	// 		},
	// 	});
	// });
	//arama butonu tıklandıgında
	$('.search-icon__education-type').click(function () {
		selectedTypes = [];
		selectedCategories = [];
		selectedLocations = [];
		pagination = 1;
		searchTerm = $('#search-input').val();

		// Burada searchTerm değişkeni ile input alanındaki değeri alıyoruz.
		console.log(searchTerm);
		$.ajax({
			url: "/index_filter.php",
			type: "POST",
			data: {
				searchTerm, searchTerm,
				pagination: pagination,
			},
			success: function (cevap) {
				$('.list-filters-items').html(cevap);
			},
		});
		// Arama sayfasına yönlendiriyoruz ve URL'e searchTerm değerini ekliyoruz.
	});
	//eğitimleri filterle çek
	$('.education-type_container input[type=checkbox]').on('change', function () {
		selectedTypes = [];
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
			url: "/index_filter.php",
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
			url: "/index_filter.php",
			type: "POST",
			data: {
				pagination: pagination,
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
			url: "/index_filter.php",
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
				url: "/index_filter.php",
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
<?php include('dosyalar/dahili/ebulten.php'); ?>
<?php include('dosyalar/dahili/footer.php'); ?>