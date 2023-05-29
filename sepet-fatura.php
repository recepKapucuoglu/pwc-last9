<?php include('dosyalar/dahili/header.php');?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">SEPETİM</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Sepetim</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<form action="sepet-odeme.php" class="sepetform">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="sepet-adimlar">
							<div class="adim ok"><a href="sepet.php"><i class="icon user-icon"></i> Katılımcılar</a></div>
							<div class="adim ok"><a href="sepet-fatura.php"><i class="icon fatura-icon"></i> Fatura Bilgileri</a></div>
							<div class="adim"><a href="sepet-odeme.php"><i class="icon kk-icon"></i> Ödeme</a></div>
							<div class="adim"><a href="sepet-ozet.php"><i class="icon ozet-icon"></i> Sipariş Özeti</a></div>
							<div class="adim"><a href="sepet-sonuc.php"><i class="icon ss-icon"></i> Sipariş Tamamlandı</a></div>
						</div>
						<div class="sepet-div">
							<div class="row">
								<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
									<h3><b>Sipariş Özeti</b></h3>
									<p>Lütfen sipariş bilgilerinizi gözden geçirip onaylayın.</p>
									<table class="tablesepet sepetlist sepetozeti">
										<tbody>
											<tr>
												<td>
													<div class="urunkutusu">
														<div class="resim"><img src="dosyalar/images/egitim-1.jpg" alt="" /></div>
														<div class="adi">Sosyal Güvenlik Uygulamalarında Güncel Değişiklikler <br /><small>Eğitim Tarihi: 07.10.2019</small></div>
													</div>
												</td>
												<td>2 Adet</td>
												<td>
													<div class="fiyat">
														<del>1.955,99 TL</del>
														<b>1.955,99 TL</b>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<h4><b>Fatura Detayları</b></h4>
									<br />
									<div class="row">
									<span class="radiobox-div">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<input class="magic-radio" type="radio" id="bireysel" name="fatura_type" class="odemeyontemi" checked="checked"/>
											<label for="bireysel" style="width: 110px;float: left;">Bireysel</label>
											<input class="magic-radio" type="radio" id="kurumsal" name="fatura_type" class="odemeyontemi" />
											<label for="kurumsal" style="width: 110px;float: left;">Kurumsal</label>
											<br/><br/>
										</div>
									</span>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
											<div class="label-div3">
												<label>Ad*</label>
												<input type="text" name="fatura_ad" value=""/>
											</div>
										</div>
										<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
											<div class="label-div3">
												<label>Soyad*</label>
												<input type="text" name="fatura_soyad" value=""/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
											<div class="label-div3">
												<label>Şirket İsmi*</label>
												<input type="text" name="fatura_sirket" value=""/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
											<div class="label-div3">
												<label>Ülke</label>
												<select name="fatura_ulke" id="" class="select2add">
													<option value="Türkiye">Türkiye</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
											<div class="label-div3">
												<label>Adres</label>
												<input type="text" name="fatura_adres1" value=""/>
												<input type="text" name="fatura_adres2" value=""/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
											<div class="label-div3">
												<label>Posta Kodu</label>
												<input type="text" name="fatura_pk" value=""/>
											</div>
										</div>
										<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
											<div class="label-div3">
												<label>İl*</label>
												<select name="fatura_il" id="" class="select2add">
													<option value="İstanbul">İstanbul</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
											<div class="label-div3">
												<label>İlçe*</label>
												<select name="fatura_ilce" id="" class="select2add">
													<option value="Beşiktaş">Beşiktaş</option>
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
											<div class="label-div3">
												<label>Telefon*</label>
												<input type="tel" name="fatura_telefon" value=""/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
											<div class="label-div3">
												<label>E-Posta*</label>
												<input type="email" name="fatura_email" value=""/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
											<div class="label-div3">
												<label>Adres Detayı</label>
												<textarea name="fatura_adresdetayi" id="" cols="30" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<aside>
										<div class="bilesen">
											<div class="baslik">Toplam Ücret</div>
											<div class="bilesenic">
												<div class="sepettoplam">
													<div class="satir">
														<span>K.D.V</span>
														<b>1,99 TL</b>
													</div>
													<div class="satir toplamsatiri">
														<span>Toplam</span>
														<b>1.955,99 TL</b>
													</div>
												</div>
											</div>
										</div>
										<button class="buton renk1"><span>Devam Et</span></button>
										
										<div class="label-div3">
											<input type="text" name="kupon" class="kuponinput" placeholder="Çek / Promosyon Kodu" value=""/>
										</div>
									</aside>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
<?php include('dosyalar/dahili/footer.php');?>