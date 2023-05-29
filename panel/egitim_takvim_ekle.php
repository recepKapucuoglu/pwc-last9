<?php include('_header.php'); ?>


<section role="main" class="content-body">
	<header class="page-header">
		<h2>Eğitim Takvimi</h2>
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
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<div class="card-actions">

				<a href="#" class="fa fa-caret-down"></a>
				<a href="#" class="fa fa-times"></a>
			</div>
			<h2 class="card-title">
				Yeni Eğitim Takvimi Ekle
			</h2>
		</header>
		<div class="card-body">
			<?php

			if (isset($_POST['edu_id'])) {

				$str = $_POST['edu_id'];
				$parts = explode(',', $str); // stringi ',' karakterine göre parçalara ayırır
				$edu_id = substr($parts[0], 3); // 'id=' değeri
				$type_id = substr($parts[1], 8); // 'type_id degeri
				$type_id= $type_id ? $type_id : null;
				
				if($type_id==3){ //elearning eğitimi ise
					$data = array(
						'id' => NULL,
						// 'edu_id' => t_code($_POST['edu_id']),
						'edu_id' => t_code($edu_id),
						'aciklama' => t_code($_POST['aciklama']),
						'ucret' => amountClear($_POST['ucret']),
						'durum' => tirnak_replace($_POST['durum']),
						'seo_url' => tirnak_replace($_POST['seo_url']),
						'sehir' => 83,
						'etiketler' => $_POST['etiketler'],
						'kayit_user' => $usr_id,
						'kayit_tarihi' => $db->now()
					);
					$id = $db->insert('education_calender', $data);
					if ($id) {
						echo "<div class=\"alert alert-success\">
								<strong>Tebrikler !</strong> İşlem Başarıyla Sisteme Eklenmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
							  </div>
							  <script language=\"JavaScript\">
								  function Git() {
									 location.href=\"egitim_list.php\";
								  }
								  setTimeout(\"Git()\",4000);
							  </script>";
					} else
						echo "<div class=\"alert alert-danger\">
								<strong>Hata !</strong> Hata mesajı:" . $db->getLastError() . "
							  </div>";
				}
				else{ //elearning değilse
					$data = array(
						'id' => NULL,
						// 'edu_id' => t_code($_POST['edu_id']),
						'edu_id' => t_code($edu_id),
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
					$id = $db->insert('education_calender', $data);
				if ($id) {

					foreach ($_POST['egitmenler'] as $categories) {
						$data_cate = array(
							'id' => NULL,
							'edu_cal_id' => $id,
							'ins_id' => $categories
						);
						$id_cate = $db->insert('education_instructor', $data_cate);
					}



					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> İşlem Başarıyla Sisteme Eklenmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
						  </div>
						  <script language=\"JavaScript\">
							  function Git() {
								 location.href=\"egitim_list.php\";
							  }
							  setTimeout(\"Git()\",4000);
						  </script>";
				} else
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:" . $db->getLastError() . "
						  </div>";
				}		
			}
	
			?>
			<div class="row">
				<div class="col-md-12">
					<!-- sonra bilgileri isteyen form -->
					<form action="egitim_takvim_ekle.php" method="post" class="form-horizontal form-bordered"
						enctype="multipart/form-data">
						<div class="form-body">
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
									Seçiniz</label>
								<div class="col-md-8">
									<select data-plugin-selectTwo class="form-control url_change"
										data-placeholder="Eğitim Seçiniz" id="egitim" name="edu_id" required>
										<?php
										$db->orderBy("baslik", "asc");
										$results = $db->get('education_list');
										foreach ($results as $value) {
											if (intval($_GET['id']) == $value['id']) {
												$selected = "selected";
											} else
												$selected = "";
											echo "<option " . $selected . " value=\"id=" . $value['id'] . ",type_id=" . $value['type_id'] . "\">" . $value['baslik'] . "</option>";
										}
										?>
									</select>
								</div>
							</div>


							<!--<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Açıklama</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="aciklama" maxlength="10000" rows="10"></textarea>
									</div>
								</div>-->
							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
									Tarihi</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-calendar"></i></span>
										</span>
										<input type="text" name="egitim_tarih" data-plugin-datepicker
											class="form-control url_change" />
									</div>
								</div>
							</div>
							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Başlangıç
									Saati</label>
								<div class="col-md-3">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</span>
										<input  type="text" data-plugin-timepicker id="baslangic_saat"
											name="baslangic_saat" class="form-control url_change" value=""
											data-plugin-options='{ "showMeridian": false }'>
									</div>
								</div>
								<label class="col-lg-1 control-label text-lg-right pt-2 gizleelearning"
									for="inputDefault">Bitiş Saati</label>
								<div class="col-md-3">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</span>
										<input type="text" data-plugin-timepicker name="bitis_saat" class="form-control"
											value="" data-plugin-options='{ "showMeridian": false }'>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
									Ücreti</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-try"></i></span>
										</span>
										<input class="form-control amount_mask" placeholder="1500.00 TL" name="ucret"
											type="text">
									</div>
								</div>
							</div>
							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Katılımcı
									Sayısı</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-users"></i></span>
										</span>
										<input class="form-control" placeholder="Örn: 15" name="katilimci_sayisi"
											type="number">
									</div>
								</div>
							</div>
							
							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Şehir
									Seçiniz</label>
								<div class="col-md-8">
									<select data-plugin-selectTwo class="form-control" data-placeholder="Şehir Seçiniz"
										name="sehir">
										<option value=""></option>
										<?php
										$db->orderBy("baslik", "asc");
										$results = $db->get('lookup_city');
										foreach ($results as $value) {
										
											echo "<option value=\"" . $value['id'] . "\">" . $value['baslik'] . "</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
									Adres</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-map-o"></i></span>
										</span>
										<input class="form-control" placeholder="Adres" name="adres" type="text">
									</div>
								</div>
							</div>
							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim
									Konum</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-map-marker"></i></span>
										</span>
										<input class="form-control" placeholder="Örn: 41.08727,28.9585342" name="konum"
											type="text">
									</div>
								</div>
							</div>
							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2"
									for="inputDefault">Eğitmenler</label>
								<div class="col-md-6">
									<select multiple data-plugin-selectTwo class="form-control populate"
										name="egitmenler[]">
										<?php
										$db->orderBy("adsoyad", "asc");
										$results = $db->get('instructor');
										foreach ($results as $value) {
											echo "<option value=\"" . $value['id'] . "\">" . $value['adsoyad'] . "</option>";
										}
										?>

									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2"
									for="inputDefault">Etiketler</label>
								<div class="col-md-6">
									<input name="etiketler" id="tags-input" data-role="tagsinput"
										data-tag-class="badge badge-primary" class="form-control" />

								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2"
									for="inputDefault">Seo-Url</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-link"></i></span>
										</span>
										<input class="form-control" placeholder="Seo-Url" id="seo_url" name="seo_url"
											type="text" required>

									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2"
									for="inputDefault">Durum</label>
								<div class="col-md-3">
									<div class="switch switch-sm switch-primary">
										<input type="checkbox" name="durum" data-plugin-ios-switch value="1"
											checked="checked" />
									</div>

								</div>
							</div>

							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2"
									for="inputDefault">Webex</label>
								<div class="col-md-3">
									<div class="switch switch-sm switch-warning">
										<input type="checkbox" name="webex" data-plugin-ios-switch value="1" />
									</div>

								</div>
							</div>
							<div class="form-group row gizleelearning">
								<label class="col-lg-3 control-label text-lg-right pt-2"
									for="inputDefault">Webex-Url</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-link"></i></span>
										</span>
										<input class="form-control" placeholder="Webex-Url" id="webex_url"
											name="webex_url" type="text">

									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button class="btn btn-sm btn-success" data-dismiss="modal">Bilgileri Kaydet</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	</section>
</section>

<?php include('_footer.php'); ?>