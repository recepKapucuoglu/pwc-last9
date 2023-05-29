<?php include('_header.php');

?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Satın Alma Talepleri</h2>
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
				Satın Alma Görüntüleme
			</h2>
		</header>
		<div class="card-body">
			<?php
			if (isset($_POST['id'])) {
				$id = $_POST['id'];
				$edu_cal_id = $_POST['edu_cal_id'];
				$odenen_tutar_update = $_POST['odenen_tutar_update'];
				$odenen_tutar_update = amountClear($odenen_tutar_update);
				$elearning_user_code_send=$_POST['elearning_user_code'];
			}
			//params ile id ve edu_id geliyorsa yada formdan post ile id ile edu_id geliyorsa
			if (($_GET["id"])) {
				$id = intval($_GET["id"]);
				$db->where('id', intval($_GET["id"]));
				$results = $db->get('education_order_form_list');
				foreach ($results as $value) {
					$fatura_tipi = $value['fatura_tipi'];
					$fatura_adi = $value['fatura_adi'];
					$vergi_dairesi = $value['vergi_dairesi'];
					$vergi_no = $value['vergi_no'];
					$adres = $value['adres'];
					$kayit_tarihi = $value['kayit_tarihi'];
					$egitim_adi = $value['egitim_adi'];
					$egitim_tarih = $value['egitim_tarih'];
					$tutar = $value['tutar'];
					$katilimci_sayisi = $value['katilimci_sayisi'];
					$edu_cal_id = $value['edu_cal_id'];
					$order_id = $value['id'];
					$odenen_tutar = $value['odenen_tutar'];
				}

				//elearning usercode'unu bulalım
				$db->where('id',$id); 
				$res=$db->getOne('education_order_form');
				$web_user_id=$res['user_id'];
				$db->where('id',$web_user_id);
				$res=$db->getOne('web_user');
				$elearning_user_code=$res['elearning_user_code'];
				// egitim tipini görelim
				
						$db->where('id',$id); 
						$res=$db->getOne('education_order_form');
						$edu_cal_id=$res['edu_cal_id'];
						$db->where('id',$edu_cal_id);
						$res=$db->getOne('education_calender_list');
						$education_type=$res['types'];
			} else if ($id) {
				$path = sha1(uniqid('', true));

				$data = [
					"odenen_tutar" => $odenen_tutar_update,
					"elearning_detail_path"=>$path,
				];
				$db->where('id', $id);
				$upd = $db->update('education_order_form', $data);
				//elearning_user_code güncelle.
				$data_elearning=[
					"elearning_user_code"=>$elearning_user_code_send,
				];
				$db->where('id',$id); 
				$res=$db->getOne('education_order_form');
				$web_user_id=$res['user_id'];
				$db->where('id',$web_user_id);
				$upd_elearning = $db->update('web_user', $data_elearning);
				if ($upd && $upd_elearning) {
					echo '<div class="alert alert-success"><strong>Bilgilendirme!</strong>Ödenen Tutarı Güncellediniz.</div> <script> setTimeout(function(){
						window.location.href = "https://www.okul.pwc.com.tr/panel/siparis_detay.php?id=' . $id . '&edu_id=' . $edu_cal_id . '";
					 }, 2000);</script>';
					$db->where('id', $id);
					$results = $db->get('education_order_form_list');
					foreach ($results as $value) {
						$fatura_tipi = $value['fatura_tipi'];
						$fatura_adi = $value['fatura_adi'];
						$vergi_dairesi = $value['vergi_dairesi'];
						$vergi_no = $value['vergi_no'];
						$adres = $value['adres'];
						$kayit_tarihi = $value['kayit_tarihi'];
						$egitim_adi = $value['egitim_adi'];
						$egitim_tarih = $value['egitim_tarih'];
						$tutar = $value['tutar'];
						$katilimci_sayisi = $value['katilimci_sayisi'];
						$edu_cal_id = $value['edu_cal_id'];
						$order_id = $value['id'];
						$odenen_tutar = $value['odenen_tutar'];
					}
					//elearning usercode'unu bulalım
				$db->where('id',$id); 
				$res=$db->getOne('education_order_form');
				$web_user_id=$res['user_id'];
				$db->where('id',$web_user_id);
				$res=$db->getOne('web_user');
				$elearning_user_code=$res['elearning_user_code'];
				//
						$db->where('id',$id); 
						$res=$db->getOne('education_order_form');
						$edu_cal_id=$res['edu_cal_id'];
						$db->where('id',$edu_cal_id);
						$res=$db->getOne('education_calender_list');
						$education_type=$res['types'];
					
				}
			}

			?>
			<div class="row">
				<div class="col-md-12">
					<form action="talep_detay.php" method="post" class="form-horizontal form-bordered"
						enctype="multipart/form-data">
						<div class="form-body">
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Fatura
									Tipi</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-user"></i></span>
										</span>
										<input class="form-control" value="<?php echo $fatura_tipi; ?>" readonly
											type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Fatura
									Adı</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-map-marker"></i></span>
										</span>
										<input class="form-control" value="<?php echo $fatura_adi; ?>" readonly
											type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Vergi
									Dairesi</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-envelope"></i></span>
										</span>
										<input class="form-control" value="<?php echo $vergi_dairesi; ?>" readonly
											type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Vergi
									No</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-phone"></i></span>
										</span>
										<input class="form-control" value="<?php echo $vergi_no; ?>" readonly
											type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Adres
									Bilgiler</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="form-control" readonly maxlength="10000"
										rows="2"><?php echo $adres; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Kayıt
									Tarihi</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-calendar"></i></span>
										</span>
										<input class="form-control" value="<?php echo date2Human($kayit_tarihi); ?>"
											readonly type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Eğitim
									Adı</label>
								<div class="col-md-6">
									<span class="label label-default">
										<?php echo $egitim_adi; ?>
									</span>
								</div>
							</div>
							<hr>
							<?php 	if($education_type !="E-Learning") {  ?>
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Eğitim
									Tarihi</label>
								<div class="col-md-6">
									<span class="label label-warning">
										<?php echo date2Human($egitim_tarih); ?>
									</span>
								</div>
							</div>
							<?php } ?>
						</div>
					</form>
					<form action="siparis_detay.php" method="post" class="form-horizontal form-bordered"
						enctype="multipart/form-data">
						<?php
					if($education_type=="E-Learning"){
				?>				
							<div class="form-group row">
								<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">E-learning Kullanıcı Adı
									</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-user"></i></span>
										</span>
										<input class="form-control" value="<?php echo $elearning_user_code; ?>" 
										 name="elearning_user_code"	type="text">
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="form-group row">
							<input name="id" type="hidden" id="id" value="<?= $id ?>" />
							<input name="edu_cal_id" type="hidden" id="edu_cal_id" value="<?= $edu_cal_id ?>" />
							<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Ödenen
								Tutar</label>
							<div class="col-md-3">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-try"></i></span>
									</span>
									<input class="form-control amount_mask" placeholder="1500.00 TL"
										value="<?php echo number_format($odenen_tutar, 2, '.', ''); ?> TL"
										name="odenen_tutar_update" type="text">
								</div>
							</div>
						</div>
						<hr>
						<button class="btn btn-sm btn-success" style="    float: right;
						" type="submit">Bilgileri Güncelle</button>

					</form>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-12">
					<section class="card">
						<form name="slideForm" action="siparis_list.php" method="post">
							<header class="card-header">
								<div class="card-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
								<h2 class="card-title">Katılımcı Listesi</h2>

							</header>
							<div class="card-body">
								<div id="islemList">
									<div class="table-responsive">
										<table class="table table-striped mb-none">
											<thead>
												<tr>
													<th>#</th>
													<th>Ad Soyad</th>
													<th>Telefon</th>
													<th>Email</th>
													<th>Firma</th>
													<th>Unvan</th>
													<th>Katılımcı Notu</th>

												</tr>
											</thead>
											<tbody>
												<?php
												$i = 0;
												$db->where("order_id", $order_id);
												$db->orderBy("id", "desc");
												$results = $db->get('education_order_person', array(0, 50));
												foreach ($results as $value) {
													$i++;
													?>
													<tr>
														<td>
															<?php echo $i; ?>
														</td>
														<td>
															<?php echo $value['adsoyad']; ?>
														</td>
														<td>
															<?php echo $value['telefon']; ?>
														</td>
														<td>
															<?php echo $value['email']; ?>
														</td>
														<td>
															<?php echo $value['firma']; ?>
														</td>
														<td>
															<?php echo $value['unvan']; ?>
														</td>
														<td>
															<?php echo $value['not']; ?>
														</td>
													</tr>
												<?php } ?>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</form>
					</section>
				</div>
			</div>
	</section>
</section>
<?php include('_footer.php'); ?>