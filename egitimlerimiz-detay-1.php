<?php include('dosyalar/dahili/header.php');


$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/", $page_url);
$page_url_total = count($page_url);

//Kategori URL'sini buluyoruz.
$page_categories_url = $page_url_total - 2;
$kategori_seo_url = $page_url[$page_categories_url];
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('education_list');
foreach ($results as $value) {
	$id = $value['id'];
	$edu_id = $value['id'];
	$resim = $value['resim'];
	$aciklama = t_decode($value['aciklama']);
	$resim_alt_etiket = $value['resim_alt_etiket'];
	$seo_url = $value['seo_url'];
	$egitim_suresi = $value['egitim_suresi'];
	$egitim_adi = $value['baslik'];
	$kimler_katilmali = t_decode($value['kimler_katilmali']);
	$neden_katilmali = t_decode($value['neden_katilmali']);


}

if ($_SESSION['dashboardUser']) {
	$db->where('user_id', $_SESSION['dashboardUserId']);
	$resultsFavorite = $db->get('web_user_favorite');
	$favori_array = array();
	foreach ($resultsFavorite as $valueFavorite) {
		$favori_array[] = $valueFavorite['edu_id'];
	}
}
$db->where('seo_url', $kategori_seo_url);
$resultsCategories = $db->get('categories');
foreach ($resultsCategories as $valueCategories) {
	$kategoriBaslik = $valueCategories['baslik'];
}

?>
<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
	<div class="basliklar">
		<div class="baslik">EĞİTİMLERİMİZ</div>
		<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
				<meta itemprop="position" content="1" />
			</li>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="egitimlerimiz"><span itemprop="name">Eğitimlerimiz</span></a>
				<meta itemprop="position" content="2" />
			</li>
			<?php
			if ($kategoriBaslik <> "") {
				?>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="<?php echo $kategori_seo_url; ?>"><span itemprop="name">
							<?php echo $kategoriBaslik; ?>
						</span></a>
					<meta itemprop="position" content="2" />
				</li>
			<?php } ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="javascript:;"><span itemprop="name">
						<?php echo $egitim_adi; ?>
					</span></a>
				<meta itemprop="position" content="3" />
			</li>
		</ol>
	</div>
</section>
<section class="ortakisim">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="egitimdetay">
					<figure>
						<img src="<?php echo $site_url . $resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" />
					</figure>
					<div class="schema-faq">
						<div class="schema-faq-section">
							<strong class="schema-faq-question"><i class="fas fa-graduation-cap"></i> Eğitim
								İçeriği</strong>
							<div class="schema-faq-answer" style="display: none;">
								<?php echo $aciklama; ?>
							</div>
						</div>

						<div class="schema-faq-section">
							<strong class="schema-faq-question"><i class="fas fa-users"></i> Kimler Katılmalı?</strong>
							<div class="schema-faq-answer" style="display: none;">
								<?php echo $kimler_katilmali; ?>
							</div>
						</div>
						<div class="schema-faq-section">
							<strong class="schema-faq-question"><i class="fas fa-user-plus"></i> Neden
								Katılmalı?</strong>
							<div class="schema-faq-answer" style="display: none;">
								<?php echo $neden_katilmali; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="egitimdetay egitimrightcol">
					<article>
						<header class="tip2">
							<h1 style="width:50%">
								<?php echo $egitim_adi; ?>
							</h1>
							<div class="etkilesim">
								<?php if ($_SESSION['dashboardUser']) {
									if (in_array($edu_id, $favori_array))
										$aktifEdu = "aktif";
									else
										$aktifEdu = ""; ?>
									<div class="favori <?php echo $aktifEdu; ?>" id="<?php echo $edu_id; ?>">Favorilere Ekle
									</div>
								<?php } ?>
								<div class="paylas">
									<ul>
										<li style="background:#2d2d2d; color:#fff">
											<span style="color:#fff">
												<i class="fas fa-share-alt"></i> 
												Paylaş
											</span>
											<ul style="background:#2d2d2d">
												<li style="background:#2d2d2d;">
												<a style="color:#fff" href="https://www.facebook.com/sharer/sharer.php?u=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>&quote="
														title="Share on Facebook" target="_blank"
														onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&quote=' + encodeURIComponent(document.URL)); return false;"><i
														style="filter:none" class="fab fa-facebook-f"></i> Facebook</a></li>
												<li style="background:#2d2d2d; color:#fff"><a style="color:#fff" href="https://twitter.com/intent/tweet?source=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>&text=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>"
														target="_blank" title="Tweet"
														onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><i
														style="filter:none" class="fab fa-twitter"></i> Twitter</a></li>
												<li style="background:#2d2d2d; color:#fff">
												<a style="color:#fff" href="http://www.linkedin.com/shareArticle?mini=true&url=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>&title=<?php echo $baslik; ?>&summary=&source=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>"
														target="_blank" title="Share on LinkedIn"
														onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;">
														<i style="filter:none" class="fab fa-linkedin-in"></i> LinkedIn</a></li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</header>
						<section>

							<div class="egitimsuresi">
								<span>Eğitim Süresi</span>: <b>
									<?php echo $egitim_suresi; ?>
								</b>
							</div>
							<div class="bilgial butontable buton button13" style="border:2px solid #2d2d2d"><a
									href="bilgi-formu/<?php echo $seo_url; ?>"><i class="info-icon"></i><span>Bilgi
										Al</span></a></div>
							<hr class="hrpwc" style="color:#2d2d2d">


							<?php

							$dateToday = date("Y-m-d");
							$db->where('edu_id', $id);
							$db->where('durum', 1);
							$db->where('egitim_tarih', $dateToday, '>=');
							$totalEgitim = $db->getValue("education_calender", "count(id)");

							$sql = "SELECT * FROM education_calender_list WHERE edu_id = $id AND NOT (types <=> 'E-Learning')";
							$result = $db->query($sql);
							$calenderEdu= count($result);

							if ($totalEgitim > 0 && $calenderEdu > 0) { // takvim eğitimi
								?>
								<div class="egitimTableTitle">
									<h5><b>Aktif Eğitim Tarihleri</b></h5>
								</div>
								<table class="tableacikegitim">
									<thead>
										<th>Tarih</th>
										<th>Şehir</th>
										<th>Fiyat</th>
										<th></th>
									</thead>
									<?php
									$i = 0;
									$db->where('edu_id', $id);
									$db->where('durum', 1);
									$db->where('egitim_tarih', $dateToday, '>=');
									$db->orderBy("egitim_tarih", "asc");
									$resultsCalender = $db->get('education_calender_list');
									foreach ($resultsCalender as $valueCalender) {
										$i++;
										$webex = $valueCalender['webex'];
										?>
										<tr onclick="window.location.href = '<?php echo $valueCalender['seo_url']; ?>';">
											<td>
												<?php echo date2Human($valueCalender['egitim_tarih']); ?>
											</td>
											<td>
												<?php if ($webex == 1)
													echo "Webex";
												else
													echo $valueCalender['sehir_adi']; ?>
											</td>
											<td>
												<?php if ($webex == 1)
													echo "Ücretsiz";
												else
													echo number_format($valueCalender['ucret'], 2, ',', '.') . " TL"; ?>
											</td>
											<?php if ($webex == 1) { ?>
												<td>
													<div class="satinal buton butontable renk1 button13"><a target="_blank"
															href="<?php echo $valueCalender['webex_url']; ?>"><i
																class="user-icon"></i><span>Kayıt Ol</span></a></div>
												</td>
											<?php } else { ?>
												<td>
													<div class="satinal buton butontable renk1 button13"><a
															href="uyelik/<?php echo $valueCalender['seo_url']; ?>"><i
																class="user-icon"></i><span>Kayıt Ol</span></a></div>
												</td>
											<?php } ?>
										</tr>

									<?php } ?>
								</table>

							<?php } else if (!($totalEgitim > 0) && ($calenderEdu > 0)) // tarihi geçmiş takvim eğitimi
							{ ?>
									<div class="bilgiler">
										<time>Bu eğitim için açık bir tarih bulunmamaktadır. <br />* Bilgi al formunu doldurarak
											ilgili eğitim takvimi planlandığında sizinle iletişime geçmemizi
											sağlayabilirsiniz.</time>
									</div>
							<?php } else if (!($totalEgitim > 0) && !($calenderEdu > 0)) { // elearning eğitimi
									$db->where('edu_id', $id);
									$db->where('durum', 1);
									$resultsCalender = $db->get('education_calender_list');
									$resultsCalenderCount = count($resultsCalender);
									// elearning eğitimi için takvim açılmış mı?
									if($resultsCalenderCount>0){

								?>
								
								 
										<div class="egitimTableTitle">
											<h5><b>Aktif Eğitim Tarihleri</b></h5>
										</div>
										<table class="tableacikegitim">
											<thead>
												<!-- <th>Tarih</th> -->
												<th>Yer</th>
												<th>Fiyat</th>
												<th></th>
											</thead>
										<?php
										$i = 0;
										$db->where('edu_id', $id);
										$db->where('durum', 1);
										$resultsCalender = $db->get('education_calender_list');
										foreach ($resultsCalender as $valueCalender) {
											$i++;
											$webex = $valueCalender['webex'];
											?>
												<tr onclick="window.location.href = '<?php echo $valueCalender['seo_url']; ?>';">
													<!-- <td>
												//<?php echo date2Human($valueCalender['egitim_tarih']); ?>
													</td> -->
													<td>
												<?php if ($webex == 1)
													echo "Webex";
												else
													echo "E-Learning"; ?>
													</td>
													<td>
												<?php if ($webex == 1)
													echo "Ücretsiz";
												else
													echo number_format($valueCalender['ucret'], 2, ',', '.') . " TL"; ?>
													</td>
											<?php if ($webex == 1) { ?>
														<td>
															<div class="satinal buton butontable renk1 button13"><a target="_blank"
																	href="<?php echo $valueCalender['webex_url']; ?>"><i
																		class="user-icon"></i><span>Kayıt Ol</span></a></div>
														</td>
											<?php } else { ?>
														<td>
															<div class="satinal buton butontable renk1 button13"><a
																	href="uyelik/<?php echo $valueCalender['seo_url']; ?>"><i
																		class="user-icon"></i><span>Kayıt Ol</span></a></div>
														</td>
											<?php } ?>
												</tr>

									<?php } ?>
										</table>

							<?php } else{ // elearning  takvimi açılmışsa  ?>
								
								<div class="bilgiler">
										<time>Bu eğitim için açık bir tarih bulunmamaktadır. <br />* Bilgi al formunu doldurarak
											ilgili eğitim takvimi planlandığında sizinle iletişime geçmemizi
											sağlayabilirsiniz.</time>
									</div>
						<?php	}

						} ?>
						</section>



					</article>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('dosyalar/dahili/onecikanegitimler_detay.php'); ?>
<?php include('dosyalar/dahili/ebulten.php'); ?>
<?php include('dosyalar/dahili/footer.php'); ?>