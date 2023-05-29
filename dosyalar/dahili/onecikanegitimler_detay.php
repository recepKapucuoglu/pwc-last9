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
						<a href="<?php echo $valueCalender['seo_url']; ?>" class="card-href">
							<div class="card">
								<div class="card__thumb">
									<a href="<?php echo $valueCalender['seo_url']; ?>"><img src="<?php echo $site_url.$valueCalender['resim']; ?>" alt="<?php echo $valueCalender['resim_alt_etiket']; ?>" /></a>
								</div>
								<?php if( $valueCalender['types'] == "E-Learning"  ) {?>
								<div class="card__category"><a href="#">E-Learning</a></div>  <?php } ?>
								<div class="card__body">
										<div>
											<!-- <div class="favoriiptal">Favorilerimden Çıkar!</div> -->	
											<h2 class="card__title">
												<a href="<?php echo $valueCalender['seo_url']; ?>">
													<?php echo $valueCalender['egitim_adi']; ?>
												</a>
											</h2>
											<span class="card__description">
												<?php echo $valueCalender['kisa_aciklama']; ?>
											</span>
										</div>
										<div class="card__dates">
											<div class="card__time">
												<img src="dosyalar/images/calendar-alt.svg"/>
												<time><?php echo date2Human($valueCalender['egitim_tarih']); ?></time>
											</div>
											<div class="card__location">
												<img src="dosyalar/images/location-arrow.svg"/>
												<lokasyon><?php if($valueCalender['webex']==1) echo "Webex"; else echo $valueCalender['sehir_adi']; ?></lokasyon>
											</div>
											<div class="fiyat">
												<!--<del>1.673,99 TL</del>-->
												<img src="dosyalar/images/money-bill.svg"/>
												<b><?php if($valueCalender['webex']==1) echo "Ücretsiz"; else echo number_format($valueCalender['ucret'], 2, ',', '.')."<span> TL + KDV</span>"; ?> </b>
											</div>
										</div>
										<div class="kutu-buttons">

											<a class="online-button"> <?php if( $valueCalender['types'] == "" ) echo  $valueCalender['types'];  ?> </a>
											<?php if($valueCalender['level_id']==1) $derece="Başlangıç";
												if($valueCalender['level_id']==2) $derece="Orta";
												if($valueCalender['level_id']==3) $derece="İleri";
											?> 
											<a class="baslangic-button"><?php echo $derece; ?></a>
										</div>

								</div>
							</div>
						</a>
					</div>
			<?php } ?>
			</div>
		</div>
		</div>
	</div>
</section>