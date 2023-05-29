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
		<form action="sepet-ozet.php" class="sepetform">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="sepet-adimlar">
							<div class="adim ok"><a href="sepet.php"><i class="icon user-icon"></i> Katılımcılar</a></div>
							<div class="adim ok"><a href="sepet-fatura.php"><i class="icon fatura-icon"></i> Fatura Bilgileri</a></div>
							<div class="adim ok"><a href="sepet-odeme.php"><i class="icon kk-icon"></i> Ödeme</a></div>
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
									<h4><b>Ödeme Yöntemi Seçiniz</b></h4>
									<br />
									<div class="radiotablar">
										<div class="radiotab">
											<div class="baslik">
												<span class="radiobox-div">
													<input class="magic-radio" type="radio" id="efthavale" name="odemeyontemi" class="odemeyontemi"/>
													<label for="efthavale">EFT / Havale</label>
												</span>
											</div>
											<div class="icerik">
												<div class="row">
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
														<div class="label-div3">
															<label>Ad*</label>
															<input type="text" name="havale_ad" value=""/>
														</div>
													</div>
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
														<div class="label-div3">
															<label>Soyad*</label>
															<input type="text" name="havale_soyad" value=""/>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="radiotab aktif">
											<div class="baslik">
												<span class="radiobox-div">
													<input class="magic-radio" type="radio" id="kredikarti" name="odemeyontemi" class="odemeyontemi" checked="checked"/>
													<label for="kredikarti">Kredi Kartı / Banka Kartı</label>
												</span>
											</div>
											<div class="icerik" style="display:block;">
												<div class="row">
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
														<div class="label-div3">
															<label>Kart Üzerindeki İsim*</label>
															<input type="text" name="kredikarti_adsoyad" value=""/>
														</div>
													</div>
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
														<div class="label-div3">
															<label>Kredi Kartı Numarası*</label>
															<input type="text" name="kredikarti_numarasi" id="kartno" value=""/>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
														<div class="label-div3">
															<label>Son Kullanma Tarihi*</label>
															<div class="row">
																<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
																	<input type="text" name="kredikarti_ay" value="" id="kkay" placeholder="Ay"/>
																</div>
																<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
																	<input type="text" name="kredikarti_yil" value="" id="kkyil" placeholder="Yıl"/>
																</div>
															</div>
														</div>
													</div>
													<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
														<div class="label-div3">
															<label>Güvenlik Numarası (CVV)*</label>
															<input type="text" name="kredikarti_cvv" id="cvv" value=""/>
														</div>
													</div>
													<div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
														<a href="#" class="cvvsoru">?</a>
													</div>
												</div>
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