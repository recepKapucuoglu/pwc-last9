<?php  $sayi = intval($_GET['katilimci']);
if($sayi>15) $sayi=15;
 	for($katilimci_sayisi=2; $katilimci_sayisi<=$sayi; $katilimci_sayisi++){ 
 ?>
<div class="katilimci_satir">
	<div class="row">
		<div class="col-md-6 col-lg-6">
			
			<div class="row">
				<div class="col-md-12">
					<h3 class="title-normal" style="margin-top:25px;"><?php echo $katilimci_sayisi; ?>. Katılımcı Bilgileri</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<input class="form-control form-control-name" placeholder="Ad Soyad *" name="katilimci_adsoyad[<?php echo $katilimci_sayisi; ?>]" id="adsoyad_<?php echo $katilimci_sayisi; ?>" type="text" required="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<input class="form-control form-control-name" placeholder="Unvan *" name="katilimci_unvan[<?php echo $katilimci_sayisi; ?>]" id="unvan_<?php echo $katilimci_sayisi; ?>" type="text" required="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<input class="form-control form-control-name" placeholder="Firma *" name="katilimci_firma_adi[<?php echo $katilimci_sayisi; ?>]" id="firma_adi_<?php echo $katilimci_sayisi; ?>" type="text">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<input class="form-control form-control-name telefon" placeholder="Telefon" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="11" name="katilimci_telefon[<?php echo $katilimci_sayisi; ?>]" id="telefon_<?php echo $katilimci_sayisi; ?>" type="text">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input class="form-control form-control-email" placeholder="E-mail *" name="katilimci_email[<?php echo $katilimci_sayisi; ?>]" id="email_<?php echo $katilimci_sayisi; ?>" type="email" required="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input class="form-control form-control gsm" placeholder="Cep Telefonu *" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="11" id="gsm_<?php echo $katilimci_sayisi; ?>" name="katilimci_gsm[<?php echo $katilimci_sayisi; ?>]" required="">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<input class="form-control form-control-name" placeholder="Not" name="katilimci_not[<?php echo $katilimci_sayisi; ?>]" id="katilimci_not_<?php echo $katilimci_sayisi; ?>" type="text">
					</div>
				</div>
				<div class="col-md-8">
					
					<div class="cevaplar" style="padding-top:18px">
							<label for="alumnisSoru_<?php echo $katilimci_sayisi; ?>" style="padding-right:20px; padding-bottom:20px">Eski PwC Çalışanı</label>
							<input type="radio" name="katilimci_alumni[<?php echo $katilimci_sayisi; ?>]" value="1" class="katilimci_alumni_<?php echo $katilimci_sayisi; ?>" id="alumnisEvet_<?php echo $katilimci_sayisi; ?>" />
							<label for="alumnisEvet_<?php echo $katilimci_sayisi; ?>" style="padding-right:20px; padding-bottom:20px">Evet</label>
						
							<input style="padding-left:20px;" type="radio" name="katilimci_alumni[<?php echo $katilimci_sayisi; ?>]" class="katilimci_alumni_<?php echo $katilimci_sayisi; ?>" id="alumnisHayir_<?php echo $katilimci_sayisi; ?>" value="2"  />
							<label for="alumnisHayir_<?php echo $katilimci_sayisi; ?>">Hayır</label>
							
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id="ayrilma_<?php echo $katilimci_sayisi; ?>" style="display:none">
						<input class="form-control form-control-name" placeholder="Ayrılma Yılınız *" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" name="katilimci_alumni_yil[<?php echo $katilimci_sayisi; ?>]" id="katilimci_alumni_yil_<?php echo $katilimci_sayisi; ?>" type="text">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-6">
		
			<div class="ts-map-tabs">
				<ul class="nav" role="tablist">
					  <li class="nav-item">
					  <a class="nav-link active" href="#workshop_1_form_<?php echo $katilimci_sayisi; ?>" role="tab" data-toggle="tab">09:00 - 09:45</a>
					  </li>
					  <li class="nav-item">
					  <a class="nav-link" href="#workshop_2_form_<?php echo $katilimci_sayisi; ?>" role="tab" data-toggle="tab">12:00 - 12:45</a>
					  </li>
					  <li class="nav-item">
					  <a class="nav-link" href="#workshop_3_form_<?php echo $katilimci_sayisi; ?>" role="tab" data-toggle="tab">15:45 - 16:30</a>
					  </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content direction-tabs">
					  <div role="tabpanel" class="tab-pane active" id="workshop_1_form_<?php echo $katilimci_sayisi; ?>">
					  <div class="direction-tabs-content">
							<p class="derecttion-vanue">
								<input type="radio" name="katilimci_workshop_1[<?php echo $katilimci_sayisi; ?>]" class="workshop_1_<?php echo $katilimci_sayisi; ?>" id="ws_1_<?php echo $katilimci_sayisi; ?>" value="KDVde Son Dönem Değişiklikleri ve Beklenen Gelişmeler"> <label for="ws_1_<?php echo $katilimci_sayisi; ?>"> KDV'de Son Dönem Değişiklikleri ve Beklenen Gelişmeler</label><br/>
								<input type="radio" name="katilimci_workshop_1[<?php echo $katilimci_sayisi; ?>]" class="workshop_1_<?php echo $katilimci_sayisi; ?>" id="ws_2_<?php echo $katilimci_sayisi; ?>" value="UFRS16 - Kiralama Standardı"> <label for="ws_2_<?php echo $katilimci_sayisi; ?>"> UFRS16 - "Kiralamalar" Standardı</label><br/>
								<input type="radio" name="katilimci_workshop_1[<?php echo $katilimci_sayisi; ?>]" class="workshop_1_<?php echo $katilimci_sayisi; ?>" id="ws_4_<?php echo $katilimci_sayisi; ?>" value="SAP S/4 HANA Dönüşümlerinden Çıkardığımız Dersler"> <label for="ws_4_<?php echo $katilimci_sayisi; ?>"> SAP S/4 HANA Dönüşümlerinden Çıkardığımız Dersler</label><br/>
								<input type="radio" name="katilimci_workshop_1[<?php echo $katilimci_sayisi; ?>]" class="workshop_1_<?php echo $katilimci_sayisi; ?>" id="ws_5_<?php echo $katilimci_sayisi; ?>" value="Stratejik Maliyet Yönetimi ve Dijital Satınalma"> <label for="ws_5_<?php echo $katilimci_sayisi; ?>"> Stratejik Maliyet Yönetimi ve Dijital Satınalma</label><br/>
								<input type="radio" name="katilimci_workshop_1[<?php echo $katilimci_sayisi; ?>]" class="workshop_1_<?php echo $katilimci_sayisi; ?>" id="ws_6_<?php echo $katilimci_sayisi; ?>" value="İş Yapmanın ve Raporlamanın Yeni Yolu: Entegre Düşünce"> <label for="ws_6_<?php echo $katilimci_sayisi; ?>"> İş Yapmanın ve Raporlamanın Yeni Yolu: Entegre Düşünce</label><br/>
								<input type="radio" name="katilimci_workshop_1[<?php echo $katilimci_sayisi; ?>]" class="workshop_1_<?php echo $katilimci_sayisi; ?>" id="ws_7_<?php echo $katilimci_sayisi; ?>" value="Muhasebede Son Trendler: Değişime hazır mıyız?"> <label for="ws_7_<?php echo $katilimci_sayisi; ?>"> Muhasebede Son Trendler: Değişime hazır mıyız?</label>	<br/>													
								<input type="radio" name="katilimci_workshop_1[<?php echo $katilimci_sayisi; ?>]" class="workshop_1_<?php echo $katilimci_sayisi; ?>" id="ws_8_<?php echo $katilimci_sayisi; ?>" value="Workshop programına katılmayacağım."> <label for="ws_8_<?php echo $katilimci_sayisi; ?>" style="color:#d93954"> Workshop programına katılmayacağım.</label>														
							</p>
					  </div><!-- direction tabs end-->
					  </div><!-- tab pane end-->
					  <div role="tabpanel" class="tab-pane fade" id="workshop_2_form_<?php echo $katilimci_sayisi; ?>">
					  <div class="direction-tabs-content">
							<p class="derecttion-vanue">
								<input type="radio" name="katilimci_workshop_2[<?php echo $katilimci_sayisi; ?>]" class="workshop_2_<?php echo $katilimci_sayisi; ?>" id="ws_9_<?php echo $katilimci_sayisi; ?>" value="E-dönüşüm Uygulamaları ve E-irsaliye Sürecine Uyum"> <label for="ws_9_<?php echo $katilimci_sayisi; ?>"> E-dönüşüm Uygulamaları ve E-irsaliye Sürecine Uyum</label><br/>
								<input type="radio" name="katilimci_workshop_2[<?php echo $katilimci_sayisi; ?>]" class="workshop_2_<?php echo $katilimci_sayisi; ?>" id="ws_10_<?php echo $katilimci_sayisi; ?>" value="Gümrük İncelemelerinde Son Gelişmeler ve İncelemeye Hazırlıklı Olmak İçin Teknoloji Bazlı Yaklaşımlar"> <label for="ws_10_<?php echo $katilimci_sayisi; ?>" style="display:unset"> Gümrük İncelemelerinde Son Gelişmeler ve İncelemeye Hazırlıklı Olmak için Teknoloji Bazlı Yaklaşımlar</label><br/>
								
								<input type="radio" name="katilimci_workshop_2[<?php echo $katilimci_sayisi; ?>]" class="workshop_2_<?php echo $katilimci_sayisi; ?>" disabled id="ws_11_<?php echo $katilimci_sayisi; ?>" value="Dijital Çağda Yönetim Raporlaması"> <label for="ws_11_<?php echo $katilimci_sayisi; ?>"> Dijital Çağda Yönetim Raporlaması <span style="color:#d93954">(Doldu)<span></label><br/>
								<input type="radio" name="katilimci_workshop_2[<?php echo $katilimci_sayisi; ?>]" class="workshop_2_<?php echo $katilimci_sayisi; ?>" id="ws_12_<?php echo $katilimci_sayisi; ?>" value="Müşteri deneyimi.. Hemen şimdi"> <label for="ws_12_<?php echo $katilimci_sayisi; ?>"> Müşteri deneyimi... Hemen şimdi</label><br/>
								<input type="radio" name="katilimci_workshop_2[<?php echo $katilimci_sayisi; ?>]" class="workshop_2_<?php echo $katilimci_sayisi; ?>" id="ws_13_<?php echo $katilimci_sayisi; ?>" value="Yeniden Yapılandırma"> <label for="ws_13_<?php echo $katilimci_sayisi; ?>"> Yeniden Yapılandırma</label><br/>
								<input type="radio" name="katilimci_workshop_2[<?php echo $katilimci_sayisi; ?>]" class="workshop_2_<?php echo $katilimci_sayisi; ?>" id="ws_14_<?php echo $katilimci_sayisi; ?>" value="Kişisel Veri İhlallerine Müdahale ve Siber Kriz Yönetimi"> <label for="ws_14_<?php echo $katilimci_sayisi; ?>"> Kişisel Veri İhlallerine Müdahale ve Siber Kriz Yönetimi</label>	<br/>
								<input type="radio" name="katilimci_workshop_2[<?php echo $katilimci_sayisi; ?>]" class="workshop_2_<?php echo $katilimci_sayisi; ?>" id="ws_15_<?php echo $katilimci_sayisi; ?>" value="Workshop programına katılmayacağım."> <label for="ws_15_<?php echo $katilimci_sayisi; ?>" style="color:#d93954"> Workshop programına katılmayacağım.</label>																	
							</p>
					  </div><!-- direction tabs end-->
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="workshop_3_form_<?php echo $katilimci_sayisi; ?>">
					  <div class="direction-tabs-content">
							<p class="derecttion-vanue">
								<input type="radio" name="katilimci_workshop_3[<?php echo $katilimci_sayisi; ?>]" class="workshop_3_<?php echo $katilimci_sayisi; ?>" id="ws_16_<?php echo $katilimci_sayisi; ?>" value="Yatırım ve AR-GE Teşvik Sistemindeki Güncel Gelişmeler"> <label for="ws_16_<?php echo $katilimci_sayisi; ?>"> Yatırım ve AR-GE Teşvik Sistemindeki Güncel Gelişmeler</label><br/>
								<input type="radio" name="katilimci_workshop_3[<?php echo $katilimci_sayisi; ?>]" class="workshop_3_<?php echo $katilimci_sayisi; ?>" id="ws_17_<?php echo $katilimci_sayisi; ?>" value="KÜMİ - Küçük ve Mikro İşletmeler için Finansal Raporlama Standartları"> <label for="ws_17_<?php echo $katilimci_sayisi; ?>"> KÜMİ - Küçük ve Mikro İşletmeler için Finansal Raporlama Standartları</label><br/>
								<input type="radio" name="katilimci_workshop_3[<?php echo $katilimci_sayisi; ?>]" class="workshop_3_<?php echo $katilimci_sayisi; ?>" id="ws_3_<?php echo $katilimci_sayisi; ?>" value="Dijital Dönüşüm Hakkında Doğru Bilinen Yanlışlar"> <label for="ws_3_<?php echo $katilimci_sayisi; ?>"> Dijital Dönüşüm Hakkında Doğru Bilinen Yanlışlar</label><br/>
								
								<input type="radio" name="katilimci_workshop_3[<?php echo $katilimci_sayisi; ?>]" class="workshop_3_<?php echo $katilimci_sayisi; ?>" id="ws_18_<?php echo $katilimci_sayisi; ?>" value="İç Denetimde Dijitalleşme"> <label for="ws_18_<?php echo $katilimci_sayisi; ?>"> İç Denetimde Dijitalleşme</label><br/>
								<input type="radio" name="katilimci_workshop_3[<?php echo $katilimci_sayisi; ?>]" class="workshop_3_<?php echo $katilimci_sayisi; ?>" id="ws_19_<?php echo $katilimci_sayisi; ?>" value="GDPR: Nerede, Nasıl, Ne zaman?"> <label for="ws_19_<?php echo $katilimci_sayisi; ?>"> GDPR: Nerede, Nasıl, Ne zaman?</label><br/>
								<input type="radio" name="katilimci_workshop_3[<?php echo $katilimci_sayisi; ?>]" class="workshop_3_<?php echo $katilimci_sayisi; ?>" id="ws_20_<?php echo $katilimci_sayisi; ?>" value="Krizlere Hazırlık ve Suistimal Riskleri"> <label for="ws_20_<?php echo $katilimci_sayisi; ?>"> Krizlere Hazırlık ve Suistimal Riskleri</label><br/>
								<input type="radio" name="katilimci_workshop_3[<?php echo $katilimci_sayisi; ?>]" class="workshop_3_<?php echo $katilimci_sayisi; ?>" id="ws_21_<?php echo $katilimci_sayisi; ?>" value="Ücretlerin Vergilendirilmesi ve Sosyal Güvenlikteki Riskler ve Fırsatlar"> <label for="ws_21_<?php echo $katilimci_sayisi; ?>"> Ücretlerin Vergilendirilmesi ve Sosyal Güvenlikteki Riskler ve Fırsatlar</label>	<br/>													
								<input type="radio" name="katilimci_workshop_3[<?php echo $katilimci_sayisi; ?>]" class="workshop_3_<?php echo $katilimci_sayisi; ?>" id="ws_22_<?php echo $katilimci_sayisi; ?>" value="Workshop programına katılmayacağım."> <label for="ws_22_<?php echo $katilimci_sayisi; ?>" style="color:#d93954"> Workshop programına katılmayacağım.</label>
							</p>
					  </div><!-- direction tabs end-->
					  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<script type="text/javascript" src="modul/check/js/custom.js"></script>
<script type="text/javascript" src="modul/check/bower_components/iCheck/icheck.min.js"></script>