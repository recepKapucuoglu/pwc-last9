<?php include('dosyalar/dahili/header.php');?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">İLETİŞİM</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="javascript:;"><span itemprop="name">İletişim</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim iletisimsayfasi">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<article>
						<center>
							<img src="dosyalar/images/yer-icon-2.png" alt="" style="margin-bottom:20px; width:30px" />
							<h2>Konum</h2>
							<p>Premier kampüs Ofis Adres: Gürsel, İmrahor Cd. No: 29, B Blok 6.kat 34400<br />Kâğıthane/İstanbul</p>
							
							<br />
							<br />
							<br />
							
							<img src="dosyalar/images/telefon-icon.png" alt="" style="margin-bottom:20px; width:30px" />
							<h2>Telefon</h2>
							<p><a href="tel:+902123765980">0 (212) 376 59 80</a></p>
							
							<br />
							<br />
							<br />
							
							<img src="dosyalar/images/mail-icon.png" alt="" style="margin-bottom:20px; width:30px" />
							<h2>E-Posta</h2>
							<p><a href="mailto:egitim@tr.pwc.com">egitim@tr.pwc.com</a></p>
						</center>
					</article>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<article>
						<div class="iletisimFormList">
						</div>
						<form id="iletisim_form" method="post" class="form" onsubmit="return iletisim_form_gonder();">
							<div class="col-sm-12">
								<div class="baslik">
									<b>İletişim Formu</b><span>Soru ve önerileriniz için aşağıdaki bilgi formunu kullanabilirsiniz.</span>
								</div>
							</div>	
							<div class="col-sm-12 input-effect">
								<div style="display:flex; flex-direction:column">
									<label for="adsoyad">Ad Soyad</label>
									<div style="position:relative">
										<input class="effect-19" type="text" name="adsoyad" id="adsoyad" onkeyup="this.setAttribute('value', this.value);" value=""/>
										<span class="focus-border">
										<i></i>
										</span>
									</div>	
								</div>
							</div>
							<div class="col-sm-12 input-effect">
								<div style="display:flex; flex-direction:column">
									<label for="adsoyad">E-Posta*</label>
									<div style="position:relative">
										<input class="effect-19" type="email" name="email" id="email" onkeyup="this.setAttribute('value', this.value);" value=""/>
										<span class="focus-border">
										<i></i>
										</span>
									</div>	
								</div>
							</div>
							<div class="col-sm-12 input-effect">
								<div style="display:flex; flex-direction:column">
									<label for="adsoyad">Mesaj*</label>
									<div style="position:relative">
										<textarea class="effect-19" name="mesaj" id="mesaj" cols="30" rows="10" onkeyup="this.setAttribute('value', this.value);" value=""></textarea>
										<span class="focus-border">
										<i></i>
										</span>
									</div>	
								</div>
							</div>
							<div class="col-sm-12">
								<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return iletisim_form_gonder();"><i class="info-icon"></i><span>Gönder</span></a></div>
							</div>
						</form>
					</article>
					
					
					
				</div>
			</div>
		</div>
	</section>
	<div class="harita">
		<div id="map_harita" class="map"></div>
		<script>
		function requiredValues(map_id,map_lat,map_lng,map_zoom) {
			var map = new google.maps.Map(document.getElementById(map_id), {
			  center: {lat: map_lat, lng: map_lng},
			  zoom: map_zoom,
			  zoomControl: false,
			  fullscreenControl: false,
			  mapTypeControl: false,
			  streetViewControl: false,
			  styles: [
				{elementType: 'geometry', stylers: [{color: '#575757'}]},
				{elementType: 'labels.text.stroke', stylers: [{color: '#575757'}]},
				{elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
				{
				  featureType: 'administrative.locality',
				  elementType: 'labels.text.fill',
				  stylers: [{color: '#d59563'}]
				},
				{
				  featureType: 'poi',
				  stylers: [{visibility: "off"}]
				},
				{
				  featureType: 'poi.park',
				  elementType: 'geometry',
				  stylers: [{visibility: "off"}]
				},
				{
				  featureType: 'poi.park',
				  elementType: 'labels.text.fill',
				  stylers: [{visibility: "off"}]
				},
				{
				  featureType: 'road',
				  elementType: 'geometry',
				  stylers: [{color: '#2d2d2d'}]
				},
				{
				  featureType: 'road',
				  elementType: 'geometry.stroke',
				  stylers: [{color: '#212a37'}]
				},
				{
				  featureType: 'road',
				  elementType: 'labels.text.fill',
				  stylers: [{color: '#ffffff'}]
				},
				{
				  featureType: 'road.highway',
				  elementType: 'geometry',
				  stylers: [{color: '#f1c93d'}]
				},
				{
				  featureType: 'road.highway',
				  elementType: 'geometry.stroke',
				  stylers: [{color: '#1f2835'}]
				},
				{
				  featureType: 'road.highway',
				  elementType: 'labels.text.fill',
				  stylers: [{color: '#ffffff'}]
				},
				{
				  featureType: 'road.local',
				  elementType: 'geometry',
				  stylers: [{color: '#febc3d'}]
				},
				{
				  featureType: 'road.local',
				  elementType: 'geometry.stroke',
				  stylers: [{color: '#1f2835'}]
				},
				{
				  featureType: 'road.local',
				  elementType: 'labels.text.fill',
				  stylers: [{color: '#ffffff'}]
				},
				{
				  featureType: 'transit',
				  elementType: 'geometry',
				  stylers: [{color: '#575757'}]
				},
				{
				  featureType: 'transit.station',
				  elementType: 'labels.text.fill',
				  stylers: [{color: '#d59563'}]
				},
				{
				  featureType: 'water',
				  elementType: 'geometry',
				  stylers: [{color: '#17263c'}]
				},
				{
				  featureType: 'water',
				  elementType: 'labels.text.fill',
				  stylers: [{color: '#515c6d'}]
				},
				{
				  featureType: 'water',
				  elementType: 'labels.text.stroke',
				  stylers: [{color: '#17263c'}]
				}
			  ]
			});
			var image = 'dosyalar/images/mapicon.png';
			var beachMarker = new google.maps.Marker({
			  position: {lat: map_lat, lng: map_lng},
			  map: map, 
			  icon: image
			});
		}
		function initMap() {
			requiredValues('map_harita',41.042329, 29.002065,16);
		}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU5FSTgyZwcTG2xty11-n8w8q8GSjsGZQ&callback=initMap" async defer></script>
	</div>
<?php include('dosyalar/dahili/footer.php');?>