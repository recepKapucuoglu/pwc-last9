<?php include('dosyalar/dahili/header.php');?>

<section id="egitimtakvimi" style="padding:40px 0px; margin-top:171px">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="sectionbaslik">
					<h3 class="baslik">Eğitim Takvimimiz</h3>
					<p style="color:#d04a22">Yaklaşan ve güncel eğitimlerimiz hakkında bilgi almak için eğitim takvimimizi inceleyebilirsiniz.</p>
					<p>E-learning (E-öğrenme) eğitimlerimiz takvimde yer almamaktadır. E-learning eğitimlerimizi incelemek için <strong > <a href="e-learning-egitimleri.php"> tıklayınız. </a> </strong></p>
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
								eventLimit: false,
								events: [
									<?php 
									foreach($egitimler as $key=>$ay){
										foreach($ay as $egitim){
											echo '{
												groupId: "'.$egitim["groupId"].'",
												title: "'.$egitim["title"].'",
												description: "'.$egitim["ozet"].'",
												start: "'.$egitim["start"].'",
												end: "'.$egitim["end"].'",
												id: "'.$egitim["id"].'",
												url: "'.$egitim["url"].'"
											},';
										}
									}									
									?>
								],
								eventRender: function(info) {
									var ntoday = new Date().getTime();
									var eventEnd = info.event.end.getTime();
									var eventStart = info.event.start.getTime();
									var eventUrl = info.event.url;
									if (!info.event.end){
										if (eventStart < ntoday){
											$(info.el).addClass("past-event");
											$(info.el).children().addClass("past-event");
										}
									} else {
										if (eventEnd < ntoday){
											$(info.el).addClass("past-event");
											$(info.el).children().addClass("past-event");
										}
									}
									if (eventUrl == "") {
										$(info.el).addClass("past-event");
										$(info.el).children().addClass("past-event");
									}
								},
								/*eventRender: function(event, eventElement) {
									if (event.event.title == "Vergiciler için Dijital Dönüşüm, Yeni Nesil Vergi Uzmanı") {
										//eventElement.children('.fc-event-inner').css({'background-color':'yellow'});
									// element.find('.fc-event').addClass('fc-event-disabled'); 
									}
									},*/
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
					
					<div class="takvimaylar">
						<div id="calendar"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include('dosyalar/dahili/footer.php');?>