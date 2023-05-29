<section id="egitimkategorileri">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="baslik" data-golge="EĞİTİM">
					<b>Eğitim</b>
					<strong>Kategorilerimiz</strong>
				</div>
				<div class="egitimlist">
					<ul class="slaytyap" data-nav="false" data-nav="true">
						<?php
							global $db;
							$i=0;
							$db->where('durum', 1);
							$db->orderBy("sira","asc");
							$results = $db->get('categories');
							foreach ($results as $value) {
								if($i==0) echo "<li>";
								$i++;
						?>
						<!--<a href="#<?php echo $value['seo_url']; ?>" class="etiketac">#<?php echo $value['baslik']; ?></a>-->
						<a href="<?php echo $value['seo_url']; ?>"><?php echo $value['baslik']; ?></a>
						
						<?php 
								if($i==6) { echo "</li>"; $i=0; } 
						
							} 
							if($i<>0) echo "</li>"; 
						?>
						
					</ul>
					<a href="egitimlerimiz.php" class="tumu">Tüm Eğitimleri Görüntüle</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="etiketkutular">
					<div id="etiket-onecikanegitim" class="karekutular" style="display:flex;">
						<?php 
							$db->where('durum', 1);
							$db->where('egitim_tarih',$dateToday,'>=');
							if($id<>"")
								$db->where('id', $id, '<>');
							$db->orderBy("RAND ()");
							$egitimKategoriResult = $db->get('education_calender_list',array(0,4));
							
						
							foreach ($egitimKategoriResult as $valueCalender) { 
						?>
						<div class="karekutu" style="background-image:url(<?php echo $site_url.$valueCalender['resim']; ?>);">
							<span class="tag"><img src="dosyalar/images/arrow-right.png" style="width:16px"></span>
							<a href="<?php echo $valueCalender['seo_url']; ?>">
								<div class="basliklar">
									<h5><?php echo $valueCalender['egitim_adi']; ?></h5>
									<time>(<?php echo date2Human($valueCalender['egitim_tarih']); ?>)</time>
									<div class="sagok"></div>
								</div>
							</a>
						</div>
						<?php } ?>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>