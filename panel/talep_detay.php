<?php include('_header.php'); ?>				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Bilgi Formu Talepleri</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Talep İşlemleri</span></li>
			</ol>
		</div>
	</header>
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Talep Görüntüleme
			</h2>
		</header>
		<div class="card-body">
		<?php
			
			$db->where('id', intval($_GET["id"]));
			$results = $db->get('education_info_form_list');
			foreach ($results as $value) {
				$adsoyad		=	$value['adsoyad'];
				$telefon		=	$value['telefon'];
				$email			=	$value['email'];
				$sirket			=	$value['sirket'];
				$diger			=	$value['diger'];
				$kayit_tarihi	=	$value['kayit_tarihi'];
				$egitim_adi		=	$value['egitim_adi'];
				$egitim_tarih	=	$value['egitim_tarih'];
				$kontenjan		=	$value['kontenjan'];
				$duyuru			=	$value['duyuru'];
				$ozel			=	$value['ozel'];
				$katilim		=	$value['katilim'];
				$egitim_konu		=	$value['egitim_konu'];
				$katilimci_sayisi		=	$value['katilimci_sayisi'];
				$lokasyon		=	$value['lokasyon'];
				
			}

			
		?> 
		<div class="row">
			<div class="col-md-12">
				<form action="talep_detay.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Ad Soyad</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input class="form-control" value="<?php echo $adsoyad; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">E-mail</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-envelope"></i></span>
											</span>
											<input class="form-control" value="<?php echo $email; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Telefon</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-phone"></i></span>
											</span>
											<input class="form-control" value="<?php echo $telefon; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Şirket</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-map-marker"></i></span>
											</span>
											<input class="form-control" value="<?php echo $sirket; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Kayıt Tarihi</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-calendar"></i></span>
											</span>
											<input class="form-control" value="<?php echo date2Human($kayit_tarihi); ?>" readonly type="text">
										</div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Eğitim Konusu</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-question"></i></span>
											</span>
											<input class="form-control" value="<?php echo $egitim_konu; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Katılımcı Sayısı</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-question"></i></span>
											</span>
											<input class="form-control" value="<?php echo $katilimci_sayisi; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Lokasyon</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-question"></i></span>
											</span>
											<input class="form-control" value="<?php echo $lokasyon; ?>" readonly type="text">
										</div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Eğitim Adı</label>
									<div class="col-md-6">
										<span class="label label-default"><?php echo $egitim_adi; ?></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Eğitim Tarihi</label>
									<div class="col-md-6">
										<span class="label label-warning"><?php echo date2Human($egitim_tarih); ?></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Bu eğitim için kontenjan açıldığında haberdar olmak istiyorum.</label>
									<div class="col-md-6" style="pointer-events:none;">
										<div class="switch switch-sm switch-success">
											<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($kontenjan=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">PwC Business School duyurularından haberdar olmak istiyorum.</label>
									<div class="col-md-6" style="pointer-events:none;">
										<div class="switch switch-sm switch-warning">
											<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($duyuru=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Bu eğitimi çalıştığım şirket için özel olarak düzenlemek istiyorum.</label>
									<div class="col-md-6" style="pointer-events:none;">
										<div class="switch switch-sm switch-danger">
											<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($ozel=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Bu eğitim için katılıma açık bir tarih belirlendiğinde haberdar olmak istiyorum.</label>
									<div class="col-md-6" style="pointer-events:none;">
										<div class="switch switch-sm switch-info">
											<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($katilim=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Diğer Bilgiler</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="form-control" readonly maxlength="10000" rows="2"><?php echo $diger; ?></textarea>
									</div>
								</div>
								
							</div>
					</form>
			</div>
		</div>
	</section>
</section>
<?php include('_footer.php'); ?>			
			
		