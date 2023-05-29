<?php include('dosyalar/dahili/header.php');?>
	<section id="slaytlar">
		<div class="slaytalani">
			<?php
			$i = 0;
			$db->orderBy("sira","asc");
			$db->where('durum', 1);
			$results = $db->get('slide');
			foreach ($results as $value) {
				$resim = $value['resim'];
			?>
			<div class="slayt">
				<div class="basliklar">
					<div class="baslik"><?php echo $value['baslik']; ?></div>
					<div class="icerik"><?php echo $value['aciklama']; ?></div>
					<?php if($value['url']<>""){ ?><a href="<?php echo $value['url']; ?>" class="devami">Daha Fazla Bilgi</a><?php } ?>
				</div>
				<div class="saribg"></div>
				<img src="<?php echo $site_url.$value['resim']; ?>" alt="<?php echo $value['resim_alt_etiket']; ?>" />
			</div>
			<?php } ?>
		</div>
	</section>
	<section id="egitimtakvimi">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="sectionbaslik">
						<h3 class="baslik">Eğitim Takvimimiz</h3>
						<p>Yaklaşan ve güncel eğitimlerimiz hakkında bilgi almak için eğitim takvimimizi inceleyebilirsiniz.</p>
					</div>
					<div class="egitimtakvimi">
						<link href='dosyalar/moduller/fullcalendar/packages/core/main.css' rel='stylesheet' />
						<link href='dosyalar/moduller/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
						<script src='dosyalar/moduller/fullcalendar/packages/core/main.js'></script>
						<script src='dosyalar/moduller/fullcalendar/packages/core/locales/tr.js'></script>
						<script src='dosyalar/moduller/fullcalendar/packages/interaction/main.js'></script>
						<script src='dosyalar/moduller/fullcalendar/packages/daygrid/main.js'></script>
						<script>
							document.addEventListener('DOMContentLoaded', function() {
								//takvim
								var calendarEl = document.getElementById('calendar');
								var calendar = new FullCalendar.Calendar(calendarEl, {
									header:{
										left:   'prev',
										center: 'title',
										right:  'next'
									},
									plugins: [ 'interaction', 'dayGrid' ],
									locale: 'tr',
									timeZone: 'UTC+3',
									eventLimit: true,
									events: [
										<?php 
										foreach($egitimler as $key=>$ay){
											foreach($ay as $egitim){
												echo '{
													groupId: "'.$egitim["groupId"].'",
													title: "'.$egitim["title"].'",
													start: "'.$egitim["start"].'",
													end: "'.$egitim["end"].'",
													id: "'.$egitim["id"].'",
												},';
											}
										}									
										?>
									],
									dateClick: function(info) {
										var eventtarih = info.dateStr;
										var arr = eventtarih.split('-');
										var gun = arr[0]+arr[1]+arr[2];
										$.ajax({
											type: "POST",
											url: "dosyalar/dahili/ajax_egitimgetir.php",
											dataType: "json",
											data: {gun:gun},
											success : function(data){
												if(data.code != "404"){
													if (data.code == "200"){
														$('.takvimdetay .detaylar .detay').remove();
														$('.takvimdetay .detaylar .scroll-content').append(data.msg);
													} else {
														$('.takvimdetay .detaylar .detay').remove();
														$('.takvimdetay .detaylar .scroll-content').append(data.msg);
													}
													$('.takvimdetay .ustkisim .gun').text(data.tarih[2]);
													$('.takvimdetay .ustkisim .ay').text(data.tarih[1]);
													$('.takvimdetay .ustkisim .yil').text(data.tarih[0]);
												}
											}
										});
									},
									eventClick: function(info) {
										var sec = $(info.el).closest('td').index() + 1;
										//$(info.el).closest('table').find('thead td:nth-child('+sec+')').trigger("click");
										var gun = info.event.groupId;
										var id = info.event.id;
										$.ajax({
											type: "POST",
											url: "dosyalar/dahili/ajax_egitimgetir.php",
											dataType: "json",
											data: {gun:gun,id:id},
											success : function(data){
												if(data.code != "404"){
													if (data.code == "200"){
														$('.takvimdetay .detaylar .detay').remove();
														$('.takvimdetay .detaylar .scroll-content').append(data.msg);
													} else {
														$('.takvimdetay .detaylar .detay').remove();
														$('.takvimdetay .detaylar .scroll-content').append(data.msg);
													}
													$('.takvimdetay .ustkisim .gun').text(data.tarih[2]);
													$('.takvimdetay .ustkisim .ay').text(data.tarih[1]);
													$('.takvimdetay .ustkisim .yil').text(data.tarih[0]);
												}
											}
										});
									}
								});
								calendar.render();
								
							});
						</script>
						<div class="takvimdetay">
							<div class="ustkisim">
								<div class="gun"><?php echo date('d');?></div><div class="ay"><?php echo turkcetarih("F",date('F'));?></div><div class="yil"><?php echo date('Y');?></div>
								
								<a href="dosyalar/download/egitimtakvimi.pdf" target="_blank" aria-label="Aylık Eğitim Takvimini İndir!" class="kaydol hint--left hint--rounded"></a>
							</div>
							<div class="detaylar">
								<section class="scrollbar-rail">
									<h3 class="baslik-genel">Yaklaşan Eğitimler</h3>
									<?php 
									if(isMobile()) 
										$egitimKayit = 10;
									else 
										$egitimKayit = 5;
									$gun = date('Ymd');
									$echo = '';
									$dateToday = date("Y-m-d");
									$db->where('durum', 1);
									$db->where('egitim_tarih',$dateToday,'>=');
									$db->orderBy("egitim_tarih","asc");
									$resultsCalender = $db->get('education_calender_list',array(0,$egitimKayit));
									foreach ($resultsCalender as $valueCalender) {			
												
												$echo .= '
													<div id="egitim-'.$valueCalender["id"].'" class="detay">
														<a href="'.$valueCalender["seo_url"].'">
															<time>'.date2Human($valueCalender['egitim_tarih']).' '.date("H:i", strtotime($valueCalender['egitim_tarih'].'T'.$valueCalender['baslangic_saat'])).'</time>
															<h4 class="baslik">'.t_decode($valueCalender['egitim_adi']).'</h4>
															<p>'.t_decode($valueCalender['kisa_aciklama']).'</p>
															<i class="yer">'.$valueCalender['sehir_adi'].'</i>
														</a>
													</div>
												';
										
									}
									if($echo==''){
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
									}else{
										echo $echo;
									}
									?>
								</section>
							</div>
						</div>
						<div class="takvimaylar">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include('dosyalar/dahili/onecikanegitimler.php');?>
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
							<p>Şuana Kadar Tamamlanan <br />Eğitim Sayısı</p>
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
	<?php include('dosyalar/dahili/egitimkategorileri.php');?>
	<?php include('dosyalar/dahili/ebulten.php');?>
<?php include('dosyalar/dahili/footer.php');?>