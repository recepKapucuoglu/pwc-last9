<?php require_once('_db.php'); ?>
<section id="onecikanegitimler">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="sectionbaslik">
					<h3 class="baslik">Öne Çıkan Eğitimler</h3>
				</div>
			</div>
		</div>
		<div class="listeleme">
						
			<div class="listeler gridlistele">
				<div class="row">
					<?php 	
						$db->where('durum', 1);
						$db->where('egitim_tarih',$dateToday,'>=');
						if($id<>"")
							$db->where('id', $id, '<>');
						$db->orderBy("egitim_tarih","asc");
						$oneCikanEgitimlerResult = $db->get('education_calender_list',Array (0, 4));
						foreach ($oneCikanEgitimlerResult as $valueCalender) { 
					?>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
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
											<b style='font-size:14px; '><?php if($valueCalender['webex']==1) echo "Ücretsiz"; else echo number_format($valueCalender['ucret'], 2, ',', '.')." TL + KDV"; ?></b>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
			<?php } ?>
			</div>
		</div>
			<!--<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="egitimkutu-tip1 aktif" style="background:url(dosyalar/images/egitim-1.jpg);">
					<a href="#">
						<time>09.05.2019</time>
						<div class="basliklar">
							<span>Gümrük</span>
							<h4>Eğitimin Adı 1</h4>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<div class="egitimkutu-tip1" style="background:url(dosyalar/images/egitim-2.jpg);">
					<a href="#">
						<time>17.05.2019</time>
						<div class="basliklar">
							<span>Arşiv</span>
							<h4>Eğitimin Adı 2</h4>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<div class="egitimkutu-tip1" style="background:url(dosyalar/images/egitim-3.jpg);">
					<a href="#">
						<time>25.05.2019</time>
						<div class="basliklar">
							<span>Danışmanlık</span>
							<h4>Eğitimin Adı 3</h4>
						</div>
					</a>
				</div>
			</div>-->
		</div>
	</div>
</section>