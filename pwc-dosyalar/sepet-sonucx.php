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
		<form action="#" class="sepetform">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="sepet-adimlar">
							<div class="adim ok"><a href="sepet.php"><i class="icon user-icon"></i> Katılımcılar</a></div>
							<div class="adim ok"><a href="sepet-fatura.php"><i class="icon fatura-icon"></i> Fatura Bilgileri</a></div>
							<div class="adim ok"><a href="sepet-odeme.php"><i class="icon kk-icon"></i> Ödeme</a></div>
							<div class="adim ok"><a href="sepet-ozet.php"><i class="icon ozet-icon"></i> Sipariş Özeti</a></div>
							<div class="adim ok"><a href="sepet-sonuc.php"><i class="icon ss-icon"></i> Sipariş Tamamlandı</a></div>
						</div>
						<div class="sepet-div">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<center>
										<i class="far fa-check-circle"></i>
										<h3><b>Sipariş Tamamlandı</b></h3>
										<h3><strong>Sipariş Numarası: 23456789</strong></h3>
									</center>
									
									<br />
									<br />
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
									<br />
									<br />
									
									<center>
										<h3><b>Katılımcı Bilgileri</b></h3>
										<table class="katilimcitablo">
											<thead>
												<tr>
													<th>Ad Soyad</th>
													<th>Telefon</th>
													<th>E-Mail</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Cengizhan Balcı</td>
													<td>0531 508 42 65</td>
													<td>cbalci@socialthinks.com</td>
												</tr>
												<tr>
													<td>Okan Lalik</td>
													<td>0532 219 72 81</td>
													<td>olalik@socialthinks.com</td>
												</tr>
											</tbody>
										</table>
								
										<br />
										<br />
										<h3><b>Eğitim Katılım Detayları</b></h3>
										<div class="sozlesmemetinleri">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Praesent et accumsan augue, a fringilla orci. Cras lorem ante, mollis dignissim massa id, sagittis sodales tortor.  Aenean rhoncus ornare urna nec eleifend. Nam nec efficitur elit. Sed finibus velit in finibus pretium. Praesent sit amet viverra purus, eget finibus tellus. Donec vitae porttitor elit. </p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Praesent et accumsan augue, a fringilla orci. Cras lorem ante, mollis dignissim massa id, sagittis sodales tortor.  Aenean rhoncus ornare urna nec eleifend. Nam nec efficitur elit. Sed finibus velit in finibus pretium. Praesent sit amet viverra purus, eget finibus tellus. Donec vitae porttitor elit. </p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Praesent et accumsan augue, a fringilla orci. Cras lorem ante, mollis dignissim massa id, sagittis sodales tortor.  Aenean rhoncus ornare urna nec eleifend. Nam nec efficitur elit. Sed finibus velit in finibus pretium. Praesent sit amet viverra purus, eget finibus tellus. Donec vitae porttitor elit. </p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Praesent et accumsan augue, a fringilla orci. Cras lorem ante, mollis dignissim massa id, sagittis sodales tortor.  Aenean rhoncus ornare urna nec eleifend. Nam nec efficitur elit. Sed finibus velit in finibus pretium. Praesent sit amet viverra purus, eget finibus tellus. Donec vitae porttitor elit. </p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Praesent et accumsan augue, a fringilla orci. Cras lorem ante, mollis dignissim massa id, sagittis sodales tortor.  Aenean rhoncus ornare urna nec eleifend. Nam nec efficitur elit. Sed finibus velit in finibus pretium. Praesent sit amet viverra purus, eget finibus tellus. Donec vitae porttitor elit. </p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Praesent et accumsan augue, a fringilla orci. Cras lorem ante, mollis dignissim massa id, sagittis sodales tortor.  Aenean rhoncus ornare urna nec eleifend. Nam nec efficitur elit. Sed finibus velit in finibus pretium. Praesent sit amet viverra purus, eget finibus tellus. Donec vitae porttitor elit. </p>
										</div>
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
<?php include('dosyalar/dahili/footer.php');?>