<?php include('_header.php'); ?>	
				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Kategoriler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Kategori İşlemleri</span></li>
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
				Yeni Kategori Ekle
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['baslik'])
			{
				
				$resim_baslik=url_baslik_yarat($_POST['resim_alt_etiket']);		
				$banner = $_FILES["banner"]["name"];
				$fileType=$_FILES["banner"]["type"]; 
					switch($fileType){ 
					  case "image/jpg"            :$typeResult="A"; $typeUzanti=".jpg"; break;
					  case "image/jpeg"           :$typeResult="A"; $typeUzanti=".jpg"; break;
					  case "image/pjpeg"          :$typeResult="A"; $typeUzanti=".pjpeg"; break;
					  case "image/gif"            :$typeResult="A"; $typeUzanti=".gif"; break;
					  case "image/png"            :$typeResult="A"; $typeUzanti=".png"; break;
					}			
				if(($banner <> "") && ($typeResult=="A")) {
					$banner = $resim_baslik.$typeUzanti;
					define ('SITE_ROOT', realpath(dirname(__FILE__)));
					move_uploaded_file($_FILES["banner"]["tmp_name"],SITE_ROOT."/../dosyalar/images/icerik/banner/".$banner);
					$banner="/dosyalar/images/icerik/banner/".$banner;
				}
				
				
		
				$data = Array (
					'id' 				=> NULL,
					'baslik' 			=> t_code($_POST['baslik']),
					'aciklama' 			=> t_code($_POST['aciklama']),
					'resim_alt_etiket' 	=> t_code($_POST['resim_alt_etiket']),
					'durum' 			=> t_code($_POST['durum']),
					'banner' 			=> $banner,
					'seo_url' 			=> t_code($_POST['seo_url']),
					'sira' 				=> t_code($_POST['sira']),
					'meta_title' 		=> t_code($_POST['meta_title']),
					'meta_description' 	=> t_code($_POST['meta_description']),
					'meta_keywords' 	=> t_code($_POST['meta_keywords']),
					'kayit_user' 		=> $usr_id,
					'kayit_tarihi' 		=> $db->now()
				);
				$id = $db->insert ('categories', $data);
				if ($id) {
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> İşlem Başarıyla Sisteme Eklenmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
						  </div>
						  <script language=\"JavaScript\">
							  function Git() {
								 location.href=\"kategori_list.php\";
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
				
						<form action="kategori_ekle.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Başlık</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-image"></i></span>
											</span>
											<input class="form-control" placeholder="Başlık" id="url_generator" name="baslik" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">İçerik</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="aciklama" maxlength="10000" rows="10"></textarea>
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
										<div class="switch switch-sm switch-success">
											<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($durum=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Sıra</label>
									<div class="col-md-3">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-sort-numeric-asc"></i></span>
											</span>
											<input class="form-control" placeholder="Sıra" name="sira" type="text">
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
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Banner</label>
									<div class="col-md-3">
										<input type="file" class="default"  name="banner"/>
										<span class="help-block">
											 <b>Banner:</b> Yükseklik. <code>727</code> Genişlik. <code>1920</code><br/>
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
			
		