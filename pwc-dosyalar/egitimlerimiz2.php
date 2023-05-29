<?php include('dosyalar/dahili/header.php');
$egitim_search = valueClear($_GET['s']);
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
					<a itemprop="item" href="javascript:;"><span itemprop="name">Eğitimlerimiz</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<div class="listeleme">
						<div class="filtreler">
							<div class="siralama">
								<select name="orderby" id="orderby" class="select2add" data-placeholder="Sıralama">
									<option value="0">Önerilen</option>
									<option value="1">Fiyat Artan</option>
									<option value="2">Fiyat Azalan</option>
									<option value="3">A-Z</option>
									<option value="4">Z-A</option>
								</select>
							</div>
							<div class="arama">
								<form id="education_list_form" method="post">
									<input type="text" name="arama" value="<?php echo $egitim_search; ?>" placeholder="Eğitim Araması"/>
									<input type="hidden" name="listType" value="1"/>
									<input type="submit" value=""/>
								</form>
							</div>
						</div>
						<div class="listeler">
						
							<!-- Tarihi belli olan eğitimler -->
							<?php 	
								$i=0;
								$dateToday = date("Y-m-d");
								$egitimSayac=0;
								$acik_egitimler[]="";
								$db->where('durum', 1);
								$db->where('egitim_tarih',$dateToday,'>=');
								if($egitim_search<>"")
									$db->where ("(kategoriler LIKE '%".$egitim_search."%' OR egitim_adi LIKE '%".$egitim_search."%' OR etiketler LIKE '%".$egitim_search."%')");
									
								$db->orderBy("egitim_tarih","asc");
								$resultsCalender = $db->get('education_calender_list');
								foreach ($resultsCalender as $valueCalender) { 
									$acik_egitimler[]=$valueCalender['edu_id'];
									$egitimSayac++;
							?>
							<div class="egitimkutu-tip2">
								<figure>
									<div class="favori hint--left hint--rounded" aria-label="Favorilere Ekle!"></div>
									<a href="<?php echo $valueCalender['seo_url']; ?>"><img src="<?php echo $site_url.$valueCalender['resim']; ?>" alt="<?php echo $valueCalender['resim_alt_etiket']; ?>" /></a>
								</figure>
								<div class="basliklar">
									<div class="favoriiptal">Favorilerimden Çıkar!</div>
									<a href="<?php echo $valueCalender['seo_url']; ?>">
										<h4><?php echo $valueCalender['egitim_adi']; ?></h4>
										<p><?php echo $valueCalender['kisa_aciklama']; ?></p>
										<div class="bilgiler">
											<time><?php echo date2Human($valueCalender['egitim_tarih']); ?></time>
											<div class="fiyat">
												<!--<del>1.673,99 TL</del>-->
												<b><?php echo number_format($valueCalender['ucret'], 2, ',', '.'); ?> TL</b>
											</div>
										</div>
									</a>
								</div>
							</div>
							<?php $modClear=$egitimSayac%3; if($modClear==0) echo "<div class=\"clearfix\"></div>"; } ?>
							
							<!-- Açık tarihi bulunmayan eğitimler -->
							<?php 	
								$i=0;
								$db->where('durum', 1);
								if($egitim_search<>"")
									$db->where ("(kategoriler LIKE '%".$egitim_search."%' OR baslik LIKE '%".$egitim_search."%')");
								$db->orderBy("id","desc");
								$db->where('id', $acik_egitimler, 'NOT IN');
								$resultsCalender = $db->get('education_list');
								foreach ($resultsCalender as $valueCalender) { 
									$egitimSayac++;
							?>
							<div class="egitimkutu-tip2">
								<figure>
									<div class="favori hint--left hint--rounded" aria-label="Favorilere Ekle!"></div>
									<a href="<?php echo $valueCalender['seo_url']; ?>"><img src="<?php echo $site_url.$valueCalender['resim']; ?>" alt="<?php echo $valueCalender['resim_alt_etiket']; ?>" /></a>
								</figure>
								<div class="basliklar">
									<div class="favoriiptal">Favorilerimden Çıkar!</div>
									<a href="<?php echo $valueCalender['seo_url']; ?>">
										<h4><?php echo $valueCalender['baslik']; ?></h4>
										<p><?php echo $valueCalender['kisa_aciklama']; ?></p>
										<div class="bilgiler">
											<time>Bu eğitim için açık bir tarih bulunmamaktadır.</time>
										</div>
									</a>
								</div>
							</div>
							<?php $modClear=$egitimSayac%3; if($modClear==0) echo "<div class=\"clearfix\"></div>"; } ?>
							
							<?php 
								if($egitimSayac==0) 
									echo "<div class=\"alert alert-danger\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> Aradığınız kritere uygun eğitim bulunmamaktadır.
									</div>"; 
							?>
							
						</div>
						
						<!--<div class="sayfalama">
							<div class="onceki"><a href="#">Geri</a></div>
							<ol>
								<li><a href="#">1</a></li>
								<li class="aktif"><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><span>...</span></li>
								<li><a href="#">10</a></li>
							</ol>
							<div class="sonraki"><a href="#">İleri</a></div>
						</div>-->
					</div>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<aside>
						<div class="bilesen">
							<div class="baslik">Eğitimler</div>
							<div class="bilesenic">
								<div class="check-list">
									<?php
										$i=0;
										$db->where('durum', 1);
										$db->orderBy("sira","asc");
										$results = $db->get('categories');
										foreach ($results as $value) {
											$i++;
									?>
									<span>
										<input class="magic-checkbox" type="checkbox" id="check<?php echo $value['id']; ?>" value="<?php echo $value['baslik']; ?>" name="egitimCheck[]"/>
										<label for="check<?php echo $value['id']; ?>"><?php echo $value['baslik']; ?></label>
									</span>
									<?php } ?>
									
								</div>
							</div>
						</div>
						<!-- Özel Eğitim Banner -->
						<a href="#"><img src="dosyalar/images/ozel-egitim.jpg" alt="Özel Eğitim Banner"></a>
					</aside>
				</div>
			</div>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>