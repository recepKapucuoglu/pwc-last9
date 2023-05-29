<?php include('_header.php'); ?>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Eğitimler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Eğitim Takvimi İşlemleri</span></li>
			</ol>
		</div>
	</header>

	<?php
	if ($_POST['eski_id']) {
		$eski_id = $_POST['eski_id'];

		//elearning eğitimi ise 
		$db->where('id', intval($eski_id));
		$res = $db->getOne('education_calender_list');
		$edu_type = $res['types'];
		if ($edu_type == "E-Learning") {
			$data = array(
				'aciklama' => t_code($_POST['aciklama']),
				'sehir' => 83,
				'ucret' => amountClear($_POST['ucret']),
				'durum' => tirnak_replace($_POST['durum']),
				'seo_url' => tirnak_replace($_POST['seo_url']),
				'etiketler' => $_POST['etiketler'],
				'kayit_user' => $usr_id,
				'kayit_tarihi' => $db->now()
			);
			$db->where('id', $eski_id);
			$id = $db->update('education_calender', $data);
			if ($id) {
				echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
						  </div>";
			} else
				echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:" . $db->getLastError() . "
						  </div>";
		}
		//elearning eğitimi değilse
		else {
			$data = array(
				'aciklama' => t_code($_POST['aciklama']),
				'egitim_tarih' => toMysqlDate($_POST['egitim_tarih']),
				'baslangic_saat' => tirnak_replace($_POST['baslangic_saat']),
				'bitis_saat' => tirnak_replace($_POST['bitis_saat']),
				'sehir' => tirnak_replace($_POST['sehir']),
				'adres' => tirnak_replace($_POST['adres']),
				'konum' => tirnak_replace($_POST['konum']),
				'ucret' => amountClear($_POST['ucret']),
				'durum' => tirnak_replace($_POST['durum']),
				'seo_url' => tirnak_replace($_POST['seo_url']),
				'webex' => tirnak_replace($_POST['webex']),
				'webex_url' => tirnak_replace($_POST['webex_url']),
				'etiketler' => $_POST['etiketler'],
				'katilimci_sayisi' => $_POST['katilimci_sayisi'],
				'kayit_user' => $usr_id,
				'kayit_tarihi' => $db->now()
			);
			$db->where('id', $eski_id);
			$id = $db->update('education_calender', $data);
			if ($id) {
				$db->where('edu_cal_id', $eski_id);
				if ($db->delete('education_instructor')) {
					if (count($_POST['egitmenler']) > 0) {
						foreach ($_POST['egitmenler'] as $categories) {
							$data_cate = array(
								'id' => NULL,
								'edu_cal_id' => $eski_id,
								'ins_id' => $categories
							);
							$id_cate = $db->insert('education_instructor', $data_cate);
						}
					}
				}
				echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
						  </div>";
			} else
				echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:" . $db->getLastError() . "
						  </div>";
		}
	}
	if (isset($_GET['id'])) {
		$db->where('id', intval($_GET["id"]));
	}
	if (isset($_POST['eski_id'])) {
		$db->where('id', intval($_POST['eski_id']));
	}
	$results = $db->get('education_calender');
	foreach ($results as $value) {
		$eski_id = $value['id'];
		$edu_id = $value['edu_id'];
		$aciklama = $value['aciklama'];
		$egitim_tarih = $value['egitim_tarih'];
		$baslangic_saat = $value['baslangic_saat'];
		$bitis_saat = $value['bitis_saat'];
		$sehir = $value['sehir'];
		$adres = $value['adres'];
		$konum = $value['konum'];
		$ucret = $value['ucret'];
		$seo_url = $value['seo_url'];
		$durum = $value['durum'];
		$webex_url = $value['webex_url'];
		$webex = $value['webex'];
		$etiketler = $value['etiketler'];
		$katilimci_sayisi = $value['katilimci_sayisi'];
	}

	if (isset($_GET['id'])) {
		$db->where('edu_cal_id', intval($_GET["id"]));
	}
	if (isset($_POST['eski_id'])) {
		$db->where('edu_cal_id', intval($_POST['eski_id']));
	}
	$results = $db->get('education_instructor');
	foreach ($results as $value) {
		$egitmenler[] = $value['ins_id'];
	}

	?>
	<?php

	$db->where('edu_cal_id', $eski_id);
	$totalTalep = $db->getValue("education_info_form", "count(id)");

	$db->where('edu_cal_id', $eski_id);
	$totalSiparis = $db->getValue("education_order_form", "count(id)");

	//eğitim tipini varsa görelim
	if (isset($_GET['id'])) {
		$db->where('id', intval($_GET["id"]));
	}
	if (isset($_POST['eski_id'])) {
		$db->where('id', intval($_POST['eski_id']));
	}
	$res = $db->getOne('education_calender_list');
	$edu_type = $res['types'];
	?>
	<div class="tabs tabs-primary">
		<ul class="nav nav-tabs">
			<li class="nav-item active">
				<a class="nav-link" href="#egitimDetay" data-toggle="tab"><i class="fa fa-calendar"></i> Eğitim Takvimi
					Detayları</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#egitimTalep" data-toggle="tab"><span class="badge badge-primary">
						<?php echo $totalTalep; ?>
					</span> Eğitim Bigli Talepleri</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#egitimSiparis" data-toggle="tab"><span class="badge badge-success">
						<?php echo $totalSiparis; ?>
					</span> Eğitim Satın Alma Talepleri</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="egitimDetay" class="tab-pane active">
				<form action="egitim_takvim_edit.php" method="post" class="form-horizontal form-bordered"
					enctype="multipart/form-data">
					<input name="eski_id" type="hidden" id="kime_mail" value="<?= $eski_id ?>" />
					<div class="form-body">
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
								Seçiniz</label>
							<div class="col-md-8">
								<select data-plugin-selectTwo disabled class="form-control url_change"
									data-placeholder="Eğitim Seçiniz" id="egitim" name="edu_id" required>
									<option value=""></option>
									<?php
									$db->orderBy("baslik", "asc");
									$results = $db->get('education');
									foreach ($results as $value) {
										if ($edu_id == $value['id'])
											$selected = "selected";
										else
											$selected = "";
										echo "<option " . $selected . " value=\"" . $value['id'] . "\">" . $value['baslik'] . "</option>";
									}
									?>
								</select>

							</div>
						</div>
						<?php if ($edu_type != "E-Learning") { ?>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
									Tarihi</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-calendar"></i></span>
										</span>
										<input type="text" name="egitim_tarih" data-plugin-datepicker
											value="<?php echo date2Human($egitim_tarih); ?>"
											class="form-control url_change" />
									</div>
								</div>
							</div>
						<?php }
						if ($edu_type != "E-Learning") { ?>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Başlangıç
									Saati</label>
								<div class="col-md-3">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</span>
										<input type="text" data-plugin-timepicker name="baslangic_saat"
											class="form-control url_change" value="<?php echo $baslangic_saat; ?>"
											data-plugin-options='{ "showMeridian": false }'>
									</div>
								</div>
								<label class="col-lg-1 control-label text-lg-right pt-2" for="inputDefault">Bitiş
									Saati</label>
								<div class="col-md-3">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</span>
										<input type="text" data-plugin-timepicker name="bitis_saat" class="form-control"
											value="<?php echo $bitis_saat; ?>"
											data-plugin-options='{ "showMeridian": false }'>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
								Ücreti</label>
							<div class="col-md-3">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-try"></i></span>
									</span>
									<input class="form-control amount_mask" placeholder="1500.00 TL"
										value="<?php echo number_format($ucret, 2, '.', ''); ?> TL" name="ucret"
										type="text">
								</div>
							</div>
						</div>
						<?php if ($edu_type != "E-Learning") { ?>

							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Katılımcı
									Sayısı</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-users"></i></span>
										</span>
										<input class="form-control" placeholder="Örn: 15" name="katilimci_sayisi"
											value="<?php echo $katilimci_sayisi; ?>" type="number">
									</div>
								</div>
							</div>
						<?php } ?>
						<?php if ($edu_type != "E-Learning") { ?>

							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Şehir
									Seçiniz</label>
								<div class="col-md-8">
									<select data-plugin-selectTwo class="form-control" data-placeholder="Şehir Seçiniz"
										name="sehir" required>
										<option value=""></option>
										<?php
										$db->orderBy("baslik", "asc");
										$results = $db->get('lookup_city');
										foreach ($results as $value) {
											if ($sehir == $value['id'])
												$selected = "selected";
											else
												$selected = "";
											echo "<option " . $selected . " value=\"" . $value['id'] . "\">" . $value['baslik'] . "</option>";
										}
										?>
									</select>

								</div>
							</div>
						<?php } ?>
						<?php if ($edu_type != "E-Learning") { ?>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
									Adres</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-map-o"></i></span>
										</span>
										<input class="form-control" placeholder="Adres" name="adres"
											value="<?php echo $adres; ?>" type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
									Konum</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-map-marker"></i></span>
										</span>
										<input class="form-control" placeholder="Örn: 41.08727,28.9585342"
											value="<?php echo $konum; ?>" name="konum" type="text">
									</div>
								</div>
							</div>
						<?php }
						if ($edu_type != "E-Learning") { ?>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2"
									for="inputDefault">Eğitmenler</label>
								<div class="col-md-6">
									<select multiple data-plugin-selectTwo class="form-control populate"
										name="egitmenler[]">
										<?php
										$db->orderBy("adsoyad", "asc");
										$results = $db->get('instructor');
										foreach ($results as $value) {
											if (in_array($value['id'], $egitmenler))
												$selected = "selected";
											else
												$selected = "";
											echo "<option " . $selected . " value=\"" . $value['id'] . "\">" . $value['adsoyad'] . "</option>";
										}
										?>

									</select>
								</div>
							</div>
						<?php } ?>
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2"
								for="inputDefault">Etiketler</label>
							<div class="col-md-6">
								<input name="etiketler" id="tags-input" data-role="tagsinput"
									value="<?php echo $etiketler; ?>" data-tag-class="badge badge-primary"
									class="form-control" />

							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Seo-Url</label>
							<div class="col-md-6">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-link"></i></span>
									</span>
									<input class="form-control" placeholder="Seo-Url" id="seo_url" name="seo_url"
										value="<?php echo $seo_url; ?>" type="text" required>

								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Durum</label>
							<div class="col-md-3">
								<div class="switch switch-sm switch-primary">
									<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($durum == '1' ? 'checked' : ''); ?> />
								</div>

							</div>
						</div>
						<?php if ($edu_type != "E-Learning") { ?>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Webex</label>
								<div class="col-md-3">
									<div class="switch switch-sm switch-warning">
										<input type="checkbox" name="webex" data-plugin-ios-switch value="1" <?php echo ($webex == '1' ? 'checked' : ''); ?> />
									</div>

								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2"
									for="inputDefault">Webex-Url</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-link"></i></span>
										</span>
										<input class="form-control" placeholder="Webex-Url" id="webex_url"
											value="<?php echo $webex_url; ?>" name="webex_url" type="text">

									</div>
								</div>
							</div>
						<?php } ?>



						<div class="modal-footer">
							<button class="btn btn-sm btn-success" data-dismiss="modal">Bilgileri Güncelle</button>
						</div>
					</div>
				</form>
			</div>
			<div id="egitimTalep" class="tab-pane">

				<section class="card">
					<header class="card-header card-header-transparent">
						<h2 class="card-title">Eğitim Talepleri</h2>
						<p>
							<?php echo $baslik; ?>
						</p>
					</header>
					<div class="card-body">
						<?php if ($totalTalep > 0) {

							echo "<div class=\"alert alert-success\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> İlgili eğitim için toplam " . $totalTalep . " adet bilgi talebi bulunmamaktadır. 
									</div>";
							?>
							<table class="table table-responsive-md table-striped mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Tarih</th>
										<th>Ad Soyad</th>
										<th>E-mail</th>
										<th>Telefon</th>
										<th>Şirket</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$db->where('edu_cal_id', $eski_id);
									$resultsCalender = $db->get('education_info_form');
									foreach ($resultsCalender as $valueCalender) {
										$i++;
										?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo date2Human($valueCalender['kayit_tarihi']); ?>
											</td>
											<td>
												<?php echo $valueCalender['adsoyad']; ?>
											</td>
											<td>
												<?php echo $valueCalender['email']; ?>
											</td>
											<td>
												<?php echo $valueCalender['telefon']; ?>
											</td>
											<td>
												<?php echo $valueCalender['sirket']; ?>
											</td>
											<td align="right">

												<a data-placement="top" data-toggle="tooltip" title="Bilgi Talebi Güncelle"
													href="bilgi_talebi_edit.php?id=<?php echo $valueCalender['id']; ?>&edu_id=<?php echo $eski_id; ?>"
													class="mb-1 mt-1 mr-1 btn btn-xs btn-info"><i class="fa fa-edit"></i></a>

											</td>
										</tr>
									<?php } ?>


								</tbody>
							</table>
						<?php } else {
							echo "<div class=\"alert alert-danger\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> İlgili eğitim için bilgi talebi bulunmamaktadır. 
									</div>";
						}
						?>
					</div>
				</section>
			</div>
			<div id="egitimSiparis" class="tab-pane">

				<section class="card">
					<header class="card-header card-header-transparent">
						<h2 class="card-title">Eğitim Satın Alma</h2>
						<p>
							<?php echo $baslik; ?>
						</p>
					</header>
					<div class="card-body">
						<?php if ($totalSiparis > 0) {

							echo "<div class=\"alert alert-success\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> İlgili eğitim için toplam " . $totalSiparis . " adet bilgi talebi bulunmamaktadır. 
									</div>";
							?>
							<table class="table table-responsive-md table-striped mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Ad Soyad</th>
										<th>Tarih</th>
										<th>Fatura Adı</th>
										<th>Toplam Tutar</th>
										<th>Katılımcı Sayısı</th>
										<th>Ödenen Tutar / Tutar Güncelle</th>

									</tr>
								</thead>
								<tbody>
									<?php

									$db->where('edu_cal_id', $eski_id);
									$res = $db->getOne('education_order_form');
									$user_id = $res['user_id'];
									$db->where('id', $user_id);
									$res2 = $db->getOne('web_user');
									$user_name = $res2['fullname'];
									$i = 0;
									$db->where('edu_cal_id', $eski_id);
									$resultsCalender = $db->get('education_order_form');
									foreach ($resultsCalender as $valueCalender) {
										$i++;
										?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo $user_name; ?>
											</td>
											<td>
												<?php echo date2Human($valueCalender['kayit_tarihi']); ?>
											</td>
											<td>
												<?php echo $valueCalender['fatura_adi']; ?>
											</td>
											<td>
												<?php echo number_format($valueCalender['tutar'], 2, ',', '.'); ?> TL
											</td>
											<td>
												<?php echo $valueCalender['katilimci_sayisi']; ?>
											</td>
											<td>
												<?php if ($valueCalender['odenen_tutar'] != null)
													echo $valueCalender['odenen_tutar'] . " " . "TL" ?>
													/ <a data-placement="top" data-toggle="tooltip" title="Tutar Güncelle"
														href="siparis_detay_odeme.php?id=<?php echo $valueCalender['id']; ?>&edu_id=<?php echo $eski_id; ?>"
													class="mb-1 mt-1 mr-1 btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
											</td>

											<td align="right">
												<a data-placement="top" data-toggle="tooltip" title="Satın Alma Talebi Detay"
													href="siparis_detay.php?id=<?php echo $valueCalender['id']; ?>&edu_id=<?php echo $eski_id; ?>"
													class="mb-1 mt-1 mr-1 btn btn-xs btn-info"><i class="fa fa-edit"></i></a>

											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						<?php } else {
							echo "<div class=\"alert alert-danger\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> İlgili eğitim için satın alma talebi bulunmamaktadır. 
									</div>";
						}
						?>
					</div>
				</section>
			</div>
		</div>

	</div>



</section>


<?php include('_footer.php'); ?>