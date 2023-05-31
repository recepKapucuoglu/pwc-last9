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
				<li><span>Eğitim İşlemleri</span></li>
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
				Yeni Eğitim Ekle
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['baslik'])
			{
				
				
				$resim_alt_etiket = $_POST['resim_alt_etiket'];
				if($resim_alt_etiket=="") $resim_alt_etiket = $_POST['baslik'];
				$resim_baslik=url_baslik_yarat($resim_alt_etiket);
				$resim = $_FILES["resim"]["name"];
				$fileType=$_FILES["resim"]["type"]; 
					switch($fileType){ 
					  case "image/jpg"            :$typeResult="A"; $typeUzanti=".jpg"; break;
					  case "image/jpeg"           :$typeResult="A"; $typeUzanti=".jpg"; break;
					  case "image/pjpeg"          :$typeResult="A"; $typeUzanti=".pjpeg"; break;
					  case "image/gif"            :$typeResult="A"; $typeUzanti=".gif"; break;
					  case "image/png"            :$typeResult="A"; $typeUzanti=".png"; break;
					}			
				if(($resim <> "") && ($typeResult=="A")) {
					$resim = $resim_baslik.$typeUzanti;
					define ('SITE_ROOT', realpath(dirname(__FILE__)));
					move_uploaded_file($_FILES["resim"]["tmp_name"],SITE_ROOT."/../dosyalar/images/icerik/egitim/".$resim);
					$resim="/dosyalar/images/icerik/egitim/".$resim;
				}
				
				
		
				$data = Array (
					'id' 				=> NULL,
					'baslik' 			=> $_POST['baslik'],
					'kisa_aciklama' 	=> t_code($_POST['kisa_aciklama']),
					'aciklama' 			=> t_code($_POST['aciklama']),
					'kimler_katilmali' 	=> t_code($_POST['kimler_katilmali']),
					'neden_katilmali' 	=> t_code($_POST['neden_katilmali']),
					'not' 				=> t_code($_POST['not']),
					'egitim_suresi' 	=> t_code($_POST['egitim_suresi']),
					'resim_alt_etiket' 	=> tirnak_replace($_POST['resim_alt_etiket']),
					'durum' 			=> tirnak_replace($_POST['durum']),
					'resim' 			=> $resim,
					'video'             => isset($_POST['video']) ? t_code($_POST['video']) : NULL,
					'seo_url' 			=> tirnak_replace($_POST['seo_url']),
					'meta_title' 		=> $_POST['meta_title'],
					'meta_description' 	=> $_POST['meta_description'],
					'meta_keywords' 	=> $_POST['meta_keywords'],
					'kayit_user' 		=> $usr_id,
					'kayit_tarihi' 		=> $db->now(),
					'education_level_id'=> $_POST['egitim_level'],
					'type_id'=> $_POST['egitim_type'],
				);
				$id = $db->insert ('education', $data);
				if ($id) {
					
					echo $id."<br/>";
					
					foreach ($_POST['egitim_kategori'] as $categories) {
						$data_cate = Array (
							'id' 			=> NULL,
							'edu_id' 		=> $id,
							'cate_id' 		=> $categories,
							// 'type_id' => $_POST['egitim_type'],
						);
						$id_cate = $db->insert ('education_categories', $data_cate);
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
							<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
						  </div>";
			}
		?> 
		<div class="row">
			<div class="col-md-12">
				
						<form action="egitim_ekle.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<div class="form-body">
							<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Tipi</label>
									<div class="col-md-6">
										<select data-plugin-selectTwo class="form-control populate" name="egitim_type">
											<?php
												$results = $db->get('education_type');
												foreach ($results as $value) {
													echo "<option value=\"".$value['id']."\">".$value['type']."</option>";
												}
											?>
		
										</select>
									</div>
								</div>	
							<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Kategorileri</label>
									<div class="col-md-6">
										<select multiple data-plugin-selectTwo class="form-control populate" name="egitim_kategori[]">
											<?php
												$db->orderBy("sira","asc");
												$results = $db->get('categories');
												foreach ($results as $value) {
													echo "<option value=\"".$value['id']."\">".$value['baslik']."</option>";
												}
											?>
		
										</select>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Derecesi</label>
									<div class="col-md-6">
										<select data-plugin-selectTwo class="form-control populate" name="egitim_level">
											<?php
												$results = $db->get('education_level');
												foreach ($results as $value) {
													echo "<option value=\"".$value['id']."\">".$value['level']."</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Başlık</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-graduation-cap"></i></span>
											</span>
											<input class="form-control" placeholder="Eğitim Başlık" id="url_generator" name="baslik" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Tanıtım Videosu</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-youtube"></i></span>
											</span>
											<input class="form-control" placeholder="Eğitim Tanıtım Videosu" id="video" name="video" type="url">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Kısa Açıklama</label>
									<div class="col-md-8">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-edit"></i></span>
											</span>
											<input class="form-control" placeholder="Eğitim Kısa Açıklama" name="kisa_aciklama" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Açıklama</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="aciklama" maxlength="10000" rows="10"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Kimler Katılmalı</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="kimler_katilmali" maxlength="10000" rows="10"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Neden Katılmalı</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="neden_katilmali" maxlength="10000" rows="10"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Not</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="not" maxlength="10000" rows="10"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Süresi</label>
									<div class="col-md-3">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-clock-o"></i></span>
											</span>
											<input class="form-control" placeholder="Örn: 12 Saat" name="egitim_suresi" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Seo-Url</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="Seo-Url" id="seo_url" name="seo_url" type="text">
											
										</div>
									</div>
									<div class="col-md-2">
										<a class="mb-1 mt-1 mr-1 btn btn-warning" onclick="url_generator();"><i class="fa fa-refresh"></i> Url Oluştur</a>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Durum</label>
									<div class="col-md-3">
										<div class="switch switch-sm switch-primary">
											<input type="checkbox" name="durum" data-plugin-ios-switch value="1" checked="checked" />
										</div>
										
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Meta Title</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-star"></i></span>
											</span>
											<input class="form-control" placeholder="Meta Title" name="meta_title" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Meta Description</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="form-control" name="meta_description" maxlength="10000" rows="2"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Meta Keywords</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="form-control" name="meta_keywords" maxlength="10000" rows="2"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Resim Alt Başlık</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-tags"></i></span>
											</span>
											<input class="form-control" placeholder="Resim Alt Başlık" name="resim_alt_etiket" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Resim</label>
									<div class="col-md-3">
										<input type="file" class="default"  name="resim"/>
										<span class="help-block">
											 Yükseklik. <code>500</code> Genişlik. <code>982</code>
										</span>
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
			
		